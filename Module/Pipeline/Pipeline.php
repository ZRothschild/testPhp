<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/5
 * Time: 20:38
 */

namespace Module\Pipeline;

use Closure;
use RuntimeException;
use Container\Container;
use InterfaceRepository\PipelineInterface;

class Pipeline implements PipelineInterface
{
    /**
     * The container implementation.
     * @var Container|null
     */
    protected $container;

    /**
     * The object being passed through the pipeline.
     *
     * @var mixed
     */
    protected $passable;

    /**
     * The array of class pipes.
     *
     * @var array
     */
    protected $pipes = [];

    /**
     * The method to call on each pipe.
     *
     * @var string
     */
    protected $method = 'handle';

    /**
     * Pipeline constructor.
     * @param Container|null $container
     */
    public function __construct(Container $container = null)
    {
        $this->container = $container;
    }

    /**
     * Set the object being sent through the pipeline.
     *
     * @param  mixed  $passable
     * @return $this
     */
    public function send($passable)
    {
        $this->passable = $passable;
        return $this;
    }

    /**
     * Set the array of pipes.
     *
     * @param  array|mixed  $pipes
     * @return $this
     */
    public function through($pipes)
    {
        $this->pipes = is_array($pipes) ? $pipes : func_get_args();
        return $this;
    }

    /**
     * Set the method to call on the pipes.
     *
     * @param  string  $method
     * @return $this
     */
    public function via($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * Run the pipeline with a final destination callback.
     *
     * @param  \Closure  $destination
     * @return mixed
     */
    public function then(Closure $destination)
    {
        $pipeline = array_reduce(
            array_reverse($this->pipes), $this->carry(), $this->prepareDestination($destination)
        );
        return $pipeline($this->passable);
    }

    /**
     * Run the pipeline and return the result.
     *运行管道并返回结果。运行管道并返回结果。运行管道并返回结果。
     * @return mixed
     */
    public function thenReturn()
    {
        return $this->then(function ($passable) {
            return $passable;
        });
    }

    /**
     * Get the final piece of the Closure onion.
     * 获得Closure洋葱的最后一块。
     * @param  \Closure  $destination
     * @return \Closure
     */
    protected function prepareDestination(Closure $destination)
    {
        return function ($passable) use ($destination) {
            return $destination($passable);
        };
    }

    /**
     * Get a Closure that represents a slice of the application onion.
     *
     * @return \Closure
     */
    protected function carry()
    {
        return function ($stack, $pipe) {
//            $pipe(1,function ($poster) {
//            echo "####received: $poster<br>";
//            return 3;
//        });
            return function ($passable) use ($stack, $pipe) {
                if (is_callable($pipe)) {
                    /**
                     * 如果管道是Closure的一个实例，我们将直接调用它
                     * 否则我们将从容器中解析管道并调用它
                     * 适当的方法和参数，返回结果。 函数调用函数
                     *  4 => $pipe($aa,$stack)  3 $pipe($aa,$pipe($aa,$stack))
                     *  2 $pipe($aa,$pipe($aa,$pipe($aa,$stack)))
                     *  1 $pipe($aa,$pipe($aa,$pipe($aa,$pipe($aa,$stack))) )
                     */
//                    echo "<br>####<br>";
                    return $pipe($passable, $stack);
                } elseif (!is_object($pipe)) {
                    [$name, $parameters] = $this->parsePipeString($pipe);
                    //如果管道是一个字符串，我们将解析字符串并解析出类
                    //依赖注入容器的，然后我们可以建立一个可调用的
                    //执行管道函数给出所需的参数。
                    $pipe = $this->getContainer()->make($name);
                    $parameters = array_merge([$passable, $stack], $parameters);
                } else {
                    //如果管道已经是一个对象，我们只需要一个可调用的并传递给它
                    //管道原样。 无需进行任何额外的解析和格式化
                    //因为我们给出的对象已经是一个完全实例化的对象。
                    $parameters = [$passable, $stack];
                }
                $response = method_exists($pipe, $this->method)
                    ? $pipe->{$this->method}(...$parameters)
                    : $pipe(...$parameters);
                return $response;
            };
        };
    }

    /**
     * Parse full pipe string to get name and parameters.
     * 解析整个管道字符串以获取名称和参数。: 后面是参数
     * @param  string $pipe
     * @return array
     */
    protected function parsePipeString($pipe)
    {
        [$name, $parameters] = array_pad(explode(':', $pipe, 2), 2, []);
        if (is_string($parameters)) {
            $parameters = explode(',', $parameters);
        }
        return [$name, $parameters];
    }

    /**
     * @return Container|null
     */
    protected function getContainer()
    {
        if (! $this->container) {
            throw new RuntimeException('A container instance has not been passed to the Pipeline.');
        }
        return $this->container;
    }
}
