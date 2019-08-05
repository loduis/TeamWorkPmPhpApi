<?php

class TagTest extends TestCase
{
    private $model;
    private static $id;

    public function setUp()
    {
        parent::setUp();
        $this->model = TeamWorkPm\Factory::build('tag');
    }

    /**
     * @dataProvider provider
     * @test
     */
    public function insert($data)
    {
        // =========== insert now ========= //
        try {
            self::$id = $this->model->insert($data);
            $this->assertGreaterThan(0, self::$id);
        } catch (\TeamWorkPm\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    /**
     * @depends insert
     * @dataProvider provider
     * @test
     */
    public function update($data)
    {
        try {
            $data['id'] = null;
            $this->assertTrue($this->model->save($data));
        } catch (\TeamWorkPm\Exception $e) {
            $this->assertEquals('Required field id', $e->getMessage());
        }
        $fail = [];
        try {
            // and add to this project
            $project_id = get_first_project_id();
            $data['id'] = self::$id;
            $this->assertTrue($this->model->save($data, 'project', $project_id));
        } catch (\TeamWorkPm\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    /**
     * @depends insert
     * @test
     */
    public function get()
    {
        try {
            $this->model->get(0);
            $this->fail('An expected exception has not been raised.');
        } catch (Exception $e) {
            $this->assertEquals('Invalid param id', $e->getMessage());
        }
        try {
            $tag = $this->model->get(self::$id);
            $this->assertEquals(self::$id, $tag->id);
        } catch (\TeamWorkPm\Exception $e) {
            $this->fail($e->getMessage());
        }
        // get tags in project
        try {
            $project_id = get_first_project_id();
            $tags = $this->model->getAllTagsForResource('project', $project_id);

            $this->assertGreaterThan(0, count($tags));
        } catch (\TeamWorkPm\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function provider()
    {
        return [
            [
                [
                    'name' => "Test Tag",
                    'color' => '#ae00da'
                ]
            ]
        ];
    }
}
