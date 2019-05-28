<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/5
 * Time: 20:38
 */

namespace InterfaceRepository;

use Closure;

interface PipelineInterface
{
    /**
     * Set the traveler object being sent on the pipeline.
     * 设置在管道上发送的被修饰者对象
     * 管道都使用在本对象上，或者说都修饰他
     *
     * @param  mixed  $traveler
     * @return $this
     */
    public function send($traveler);

    /**
     * Set the stops of the pipeline.
     * 设置管道的停靠点。也就是说修饰的工具方法。
     * 修饰的点集合
     *
     * @param  dynamic|array  $stops
     * @return $this
     */
    public function through($stops);

    /**
     * Set the method to call on the stops.
     *  设置方法以调用停靠点。
     * @param  string  $method
     * @return $this
     */
    public function via($method);

    /**
     * Run the pipeline with a final destination callback.
     * 使用最终目标回调运行管道。执行管道操作
     * @param  \Closure  $destination
     * @return mixed
     */
    public function then(Closure $destination);
}
