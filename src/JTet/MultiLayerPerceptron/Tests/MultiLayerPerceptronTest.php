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
    public function testInstantiation()
    {
        $mlp = new \JTet\MultiLayerPerceptron\MultiLayerPerceptron();
    }
}