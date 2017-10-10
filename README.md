# Performance Testing Data Router

## Introduction

This is intended as a basic service that sends data to an external data-sink. You can 
pecify the amount of data, optional passed-through data and concurrency.

## Configuration

You can configure the container using environment variables. The only supported
one is `PERFTEST_DATASINK`. This should be set to the URL of a data sink.

An example datasink is at `mintopia/perftest-datasink:latest`.

## Author

Jessica Smith - <jessica.smith@fasthosts.com>