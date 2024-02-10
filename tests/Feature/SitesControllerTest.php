<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\V1\SitesController;
use App\Models\WebSites;
use App\Services\SiteService\SiteServicesCreateValidate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;
use App\Services\SiteService\SiteServices;
use Mockery;

class SitesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws Exception
     * @throws ValidationException
     */
    public function testCreate()
    {
        // Create a mock for SiteServices
        $siteServicesMock = Mockery::mock(SiteServices::class);

        // Replace the expected call with actual SiteService instance
        $this->app->instance(SiteServices::class, $siteServicesMock);

        // Create an instance of the controller with the mock SiteServices
        $controller = new SitesController($siteServicesMock);

        // Mock input data
        $data = [
            'domain' => 'example.com',
            'status' => 0,
        ];

        // Create a mock for SiteServicesCreateValidate
        $siteServicesCreateValidateMock = $this->createMock(SiteServicesCreateValidate::class);
        $siteServicesCreateValidateMock->expects($this->once())
            ->method('all')
            ->willReturn($data);

        // Expect the create method to be called once with the provided data
        $siteServicesMock->shouldReceive('create')
            ->once()
            ->with($data)
            ->andReturn(true); // Mocking a successful creation

        // Call the create method on the controller with the mock SiteServicesCreateValidate
        $response = $controller->createWebsite($siteServicesCreateValidateMock);

        // Assertions
        $this->assertTrue($response); // Assuming your generator method returns true for successful creation
    }
}
