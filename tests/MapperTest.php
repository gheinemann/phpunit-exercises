<?php
namespace tests {


    class MapperTest extends \PHPUnit_Framework_TestCase {

        // run before each test
        public function setUp() {

        }

        // run after each test
        public function tearDown() {

        }

        public function titleProvider() {
            return array(
                array("M", 4),
                array("DR", 1),
                array("MME", 2),
                array("MLLE", 3),
            );
        }

        /**
         * @dataProvider titleProvider
         * @param $pInput
         * @param $pExpected
         */
        public function testMapTitle($pInput, $pExpected) {
                $mapped_data = \tools\Mapper::mapTitle($pInput);

                $this->assertEquals($pExpected, $mapped_data, "$mapped_data should return id $pExpected");

        }

        public function testMapData() {
            $data = array(
                "title" => "M"
            );

            $mapped_data = \tools\Mapper::mapData($data);

            $this->assertEquals("4", $mapped_data["gender_id"], "{$data["title"]} should return id 4");
        }
    }
}


