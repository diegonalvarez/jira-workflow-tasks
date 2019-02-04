<?php

use App\Dto\CustomerDto;
use App\RunTasks;
use PHPUnit\Framework\TestCase;

class TasksTest extends TestCase
{

    /** @test 
    * @expectedException \App\Exception\ConfigException
    */ 
    public function throwExceptionIfTemplateDoesntExist()
    {
        $runTask = $this->getMockBuilder(\App\RunTasks::class)
                        ->setConstructorArgs(['example_fail_exception'])
                        ->setMethods(['newIssueClass'])
                        ->getMock();
    }

    /** @test */
    public function creationIssueWorkflow()
    {
        $runTask = $this->getMockBuilder(\App\RunTasks::class)
                        ->setConstructorArgs(['example'])
                        ->setMethods(['newIssueClass'])
                        ->getMock();

        $newIssue = $this->getMockBuilder(\App\NewIssue::class, ['createIssue'])
                         ->setConstructorArgs([$runTask->returnProjects(), $runTask->returnEnv()])
                         ->setMethods(['createIssue'])
                         ->getMock();

        $newIssueStd = new \StdClass;
        $newIssueStd->id  = 10001;
        $newIssueStd->key = 'TEM-1';

        $newIssue->method('createIssue')
             ->willReturn($newIssueStd);

        $runTask->method('newIssueClass')
             ->willReturn($newIssue);

        $name     = 'Diego Alvarez';
        $label    = 'diego_alvarez';
        $target   = 'Argentina';

        $customerDto = new CustomerDto(
            $name,
            $label,
            $target
        );

        $runTask->action($customerDto);
        $this->assertSame('TEM-1', $runTask->returnEnv()->epicLink);
        $this->assertSame(false, $runTask->returnEnv()->parentLink);
        $this->assertSame('TEM-1', $runTask->returnEnv()->issues['customer']['main']['key']);
        $this->assertSame('TEM-1', $runTask->returnEnv()->issues['customer']['sub-task']['one']);
        $this->assertSame('TEM-1', $runTask->returnEnv()->issues['customer']['sub-task']['two']);
        $this->assertSame('TEM-1', $runTask->returnEnv()->issues['development']['main']['key']);
        $this->assertSame('TEM-1', $runTask->returnEnv()->issues['development']['sub-task']['one']);
    }
}