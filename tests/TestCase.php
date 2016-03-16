<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    protected $baseApiURL;

    protected $token;

    protected function getHeaderAuthorization()
    {
        if (empty($this->token)) {
            $this->token = IZeeAPIAdmin::loginUsingId(1);
        }
        return array('HTTP_Authorization' => $this->token);
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
}
