<?php
/**
 * JTet\MultiLayerPerceptron
 * https://github.com/jtet/MultiLayerPerceptron
 *
 * Please see http://www.spdx.org/licenses/OSL-3.0#licenseText
 * for license information.
 */
namespace JTet\MultiLayerPerceptron;

use JTet\Perceptron\Perceptron;

/**
 * Multi Layer Perceptron for more information see:
 * http://en.wikipedia.org/wiki/Multilayer_perceptron
 */
class MultiLayerPerceptron
{
    protected $vectorLength;
    protected $bias;
    protected $learningRate;

    protected $iterations;
    protected $outputNodes;
    protected $hiddenLayers;

    protected $network = array();

    /**
     * @param int   $vectorLength The number of input signals
     * @param int   $outputNodes  Number of output nodes
     * @param int   $hiddenLayers Number of hidden layers
     * @param float $bias         Bias factor
     * @param float $learningRate The learning rate 0 < x <= 1
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($vectorLength, $outputNodes = 1, $hiddenLayers = 1, $bias = 0.0, $learningRate = .5)
    {
        if ($vectorLength < 1) {
            throw new \InvalidArgumentException();
        } elseif ($learningRate <= 0 || $learningRate > 1) {
            throw new \InvalidArgumentException();
        } elseif ($outputNodes < 1) {
            throw new \InvalidArgumentException();
        } elseif ($hiddenLayers < 1) {
            throw new \InvalidArgumentException();
        }

        $this->vectorLength = $vectorLength;
        $this->bias = $bias;
        $this->learningRate = $learningRate;
        $this->outputNodes = $outputNodes;
        $this->hiddenLayers = $hiddenLayers;

        //Add input layer
        $network[0] = array();
        for ($i = 0; $i < $this->vectorLength; $i++) {
            $this->network[0][] = new Perceptron($this->vectorLength, $this->bias, $this->learningRate);
        }

        //Add hidden layers
        for ($i = 0; $i < $this->hiddenLayers; $i++) {
            $layer = $i + 1;
            $numberOfNodesInPreviousLayer = count($this->network[$layer - 1]);
            $numberOfNodesForLayer = ceil(($numberOfNodesInPreviousLayer + $this->outputNodes) / 2);
            for ($j = 0; $j < $numberOfNodesForLayer; $j++) {
                $this->network[$layer][] =
                    new Perceptron($numberOfNodesInPreviousLayer, $this->bias, $this->learningRate);
            }
        }

        //Add output layer
        $outputLayerIndex = count($this->network);
        $numberOfNodesInPreviousLayer = count($this->network[$outputLayerIndex - 1]);
        $network[$outputLayerIndex] = array();
        for ($i = 0; $i < $this->outputNodes; $i++) {
            $this->network[$outputLayerIndex][] =
                new Perceptron($numberOfNodesInPreviousLayer, $this->bias, $this->learningRate);
        }
    }

    /**
     * @return int
     */
    public function getBias()
    {
        return $this->bias;
    }

    /**
     * @param float $bias
     *
     * @throws \InvalidArgumentException
     */
    public function setBias($bias)
    {
        if (!is_numeric($bias)) {
            throw new \InvalidArgumentException();
        }
        $this->bias = $bias;
    }

    /**
     * @return float
     */
    public function getLearningRate()
    {
        return $this->learningRate;
    }

    /**
     * @param float $learningRate
     *
     * @throws \InvalidArgumentException
     */
    public function setLearningRate($learningRate)
    {
        if (!is_numeric($learningRate) || $learningRate <= 0 || $learningRate > 1) {
            throw new \InvalidArgumentException();
        }
        $this->learningRate = $learningRate;
    }

    /**
     * @param array $inputVector
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    public function test($inputVector)
    {
        if (!is_array($inputVector) || count($inputVector) != $this->vectorLength) {
            throw new \InvalidArgumentException();
        }

        $outputVector = array();
        for($i = 0; $i < count($this->network); $i++)
        {
            $outputVector = array();
            for($j = 0; $j < count($this->network[$i]); $j++)
            {
                $outputVector[] = $this->network[$i][$j]->test($inputVector);
            }
            $inputVector = $outputVector;
        }
    }

    /**
     * @param array $inputVector array of input signals
     * @param array  $outcome     array of expected outcomes for each node (0's and 1's)
     *
     * @throws \InvalidArgumentException
     */
    public function train($inputVector, $outcome)
    {
        if (!is_array($inputVector) || !(is_array($outcome) && count($outcome) == $this->outputNodes)) {
            throw new \InvalidArgumentException();
        }

        $this->iterations += 1;

        /**
         * @todo Implement
         */

    }
}
