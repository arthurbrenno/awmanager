<?php

namespace App;

use Framework\Http\Kernel;
use Framework\Http\Request;
use Framework\Http\Response;

readonly class App
{
    private Response $response;
    public function __construct(
        public Request $request,
        public Kernel  $kernel,
    )
    {
        $this->response = $this->kernel->handle($this->request);
    }

    public function run(): void
    {
        $this->response->send();
    }
}