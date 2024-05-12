# Url shortener

## Introduction:
This README provides guidance on setting up and using a Url shortener 
built using PHP, Laminas Mezzio, Redis, and Beanstalkd.

## Features:
- Generates short URLs from long URLs.
- Stores short URLs and corresponding long URLs in Redis for fast retrieval.
- Uses Beanstalkd for asynchronous job processing.

## Setup Instructions:
1. Clone the repository.
2. Create .env file from .env.example file
   ```shell script
   cp .env.example .env
   ```
3. Install dependencies:
   ```shell script
   composer install -o --ignore-platform-reqs
   ```
4. Build a docker image of the service:
   ```shell script
   make build.dev
   ```
5. Create and run all necessary containers:
   ```shell script
   docker compose up
   ```
   
## Usage:
- Send a POST request to the /url/shorten endpoint with a JSON payload containing the long URL and get url id.  

Request example:
```bash
POST /url/shorten
Content-Type: application/json
{
    "url": "https://example.com/very-long-url-with-lots-of-characters"
}
```
Response example:
```bash
Content-Type: application/json
{
    "urlId": "exampleID"
}
```
- Send a GET request to the /{urlId} endpoint to redirect from a short url to a long one.
