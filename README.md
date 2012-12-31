MultiLayerPerceptron
==========

[![Build Status](https://api.travis-ci.org/jtet/MultiLayerPerceptron.png?branch)](https://travis-ci.org/jtet/MultiLayerPerceptron)

##What is a Multilayer Perceptron?

```
"A multilayer perceptron (MLP) is a feedforward artificial neural network model that maps
 sets of input data onto a set of appropriate output. An MLP consists of multiple layers
 of nodes in a directed graph, with each layer fully connected to the next one. Except for
 the input nodes, each node is a neuron (or processing element) with a nonlinear activation
 function. MLP utilizes a supervised learning technique called backpropagation for training
 the network. MLP is a modification of the standard linear perceptron and can distinguish
 data that is not linearly separable."
```
read more at [http://en.wikipedia.org/wiki/Multilayer_perceptron](http://en.wikipedia.org/wiki/Multilayer_perceptron)

##Training

```php
for ($i = 0; $i < count($inputVectors); $i++){
    $mlp->train($inputVectors[$i], $outcomes[$i);
}
```

##Test an Input

```php
echo $mlp->test($inputVector)? "True": "False";
```

##Example

```php
$mlp = new \JTet\Perceptron\MultiLayerPerceptron(2);

$i = 0;
while($i < 100000)
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

echo $mlp->test(array(1,1))? "Incorrect\n": "Correct\n";
echo $mlp->test(array(0,1))? "Correct\n": "Incorrect\n";
echo $mlp->test(array(0,0))? "Incorrect\n": "Correct\n";
echo $mlp->test(array(1,0))? "Correct\n": "Incorrect\n";
```

##Getting MultiLayerPerceptron

Add the following to your [composer.json](http://getcomposer.org) file and run `composer update`.

```
"require": {
        "jtet/multilayerperceptron": "dev-master"
    }
```

##License
MultiLayerPerceptron is available for your use under the [OSL-3.0](http://www.spdx.org/licenses/OSL-3.0#licenseText) license.