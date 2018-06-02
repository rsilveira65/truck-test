[![Build Status](https://travis-ci.com/rsilveira65/loadsmart.svg?token=z2yf7ZpVZudwz9Cxdor9&branch=master)](https://travis-ci.com/rsilveira65/loadsmart)
# Loadsmart Backend Test

## Goal

Given a list of trucks and their current locations and a list of cargos and their pickup and delivery locations, find the optimal mapping of trucks to cargos to minimize the overall distances the trucks must travel .
Please assume that each truck can only carry up to one cargo, each truck can only make up to one trip and that some trucks may not be used at all.
Here are 2 csv files for you to complete the assignment: cargo.csv and trucks.csv . Cargo.csv is a list of cargos we need to move (with product name, origin and destination city) and trucks.csv is a list of trucks and their home city.

## Overview

As each truck should only carry up to one cargo, I've developed a solution comparing the shortest distance necessary for a truck deliver the product and go back home.
Since, as Google API and other geolocation services delegates some latency, always depending of internet connection, I've used a PHP library that calculates the distance between coordinates using the [haversine formula](https://en.wikipedia.org/wiki/Haversine_formula) preventing to do massive requests to Google servers and enhance the application performance.

## Infrastructure Requirements

- [Docker](https://docs.docker.com/install/)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Docker
Why use docker and docker-compose?
I chose docker because of the facility to setup a develop/testing environment that provides the guarantee that it will work in the same way when the solution be reviewed.
Also,  PHP and it's versions and extensions sometimes tricks you, right?

## Getting Started
Just make sure you have docker and docker-compose properly installed.
```sh
docker --version
docker-compose --version
```

In the first moment, docker will download and install the base PHP7 image and all necessary libs and extensions to run the project properly. After that, the calculate command must be executed.
```sh
docker-compose run application php main.php run:calculate --products=inputs/cargo.csv --trucks=inputs/trucks.csv

# --products= path to the cargo .csv file;
# --trucks= path to the trucks .csv file;
```

In the first moment, docker will download and install the base PHP7 image and all necessary libs and extensions to run the project properly. After that, the calculate command must be executed.
Eg: Output result table.
![alt tag](https://i.imgur.com/fzgBlIL.png)

## Unit Tests
Get unit test summary on executing

```sh
docker-compose run application composer test
```

## Generating test input files
Generate .csv input files executing

```sh
docker-compose run application php generate-test-inputs.php --type=trucks --quantity=100

# --type= input type (trucks or products);
# --quantity= quantity of file lines (default 100);
```