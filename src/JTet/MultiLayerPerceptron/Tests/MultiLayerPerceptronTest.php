<?php
/**
 * JTet\MultiLayerPerceptron\Test
 * https://github.com/jtet/MultiLayerPerceptron
 *
 * Please see http://www.spdx.org/licenses/OSL-3.0#licenseText
 * for license information.
 */
namespace JTet\MultiLayerPerceptron\Tests;

/**
 * functional tests and tests to ensure coverage
 */
class MultiLayerPerceptronTest extends \PHPUnit_Framework_TestCase
{
    public function testXOR()
    {
        $mlp = new \JTet\MultiLayerPerceptron\MultiLayerPerceptron(2);

        $i = 0;
        while($i < 1000)
        {
            $input = array(0, 0);
            $output = array(0);
            $mlp->train($input, $output);

            $input = array(0, 1);
            $output = array(1);
            $mlp->train($input, $output);

            $input = array(1,0);
            $output = array(1);
            $mlp->train($input, $output);

            $input = array(1,1);
            $output = array(0);
            $mlp->train($input, $output);

            $i++;
        }

        $this->assertFalse((bool) $mlp->test(array(1,1)));
        $this->assertTrue((bool) $mlp->test(array(0,1)));
        $this->assertTrue((bool) $mlp->test(array(1,0)));
        $this->assertFalse((bool) $mlp->test(array(0,0)));
    }
}