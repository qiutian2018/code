<?php
/**
 * Created by PhpStorm.
 * User: qiutian
 * Date: 2019/6/20
 * Time: 19:22
 */

class thinkphpQueueJob
{
    /**
     * 使用
     * $jobHanglerClassName = '\\app\\job\\TestJob';
     *   $jobQueueName = 'cjqTestJob';
     *   $jobData = [
     *      'user'=>'cjq',
     *      'date'=>date('Y-m-d H:i:s')
     *      ];
     *  $isPushed = \think\Queue::push($jobHanglerClassName,$jobData,$jobQueueName);
     */
    /**
     * exipire:
     * 非null值时,每隔expire秒会重新消费对列消息,且attempts+1
     * null值时,只消费一次
     */
    /**
     * 对列消费
     * @param Job $job
     * @param $data
     */
    public function fire(Job $job,$data)
    {
        var_dump("testjob-fire");
        var_dump($data);
        var_dump($job);
        // if do sth ok =>消费完务必删除
        // $job->delete();

        // 重试次数>x
        // if $job->attempts() > x doSpecial()
    }

    /**
     * 发起任务时的对列名
     * @param $job
     * @return mixed
     */
    private function _getQueueName($job)
    {
        return $job->getQueue();
    }

    /**
     * 消费对列的class
     * @param $job
     * @return mixed
     */
    private function _getJobClass($job)
    {
        return $job->getName();
    }

    /**
     * 对列消息详细内容
     * @param $job
     * @return mixed
     */
    private function _getQueueData($job)
    {
        return $job->getRawBody();
    }

    private function _doSpecial()
    {
        // job attempts too many times
    }
}