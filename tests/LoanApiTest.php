<?php

namespace Tests;

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

class LoanApiTest extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /**
     * Test creating a new loan.
     *
     * @return void
     */
    public function testCreateLoan()
    {
        $data = [
            'loan_title' => 'New Loan 8',
            'sum' => 6000,
            'created_date' => '2024-05-19',
        ];

        $response = $this->call('POST', '/loans', $data);

        $this->assertEquals(201, $response->status());

        $responseData = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('loan_title', $responseData);
        $this->assertArrayHasKey('sum', $responseData);
        $this->assertArrayHasKey('created_date', $responseData);

        // Additional assertions on the response data if needed
    }
    /**
     * Test updating loan.
     *
     * @return void
     */

    public function testUpdateLoan()
    {
        $data = [
            'loan_title' => 'Updated Loan 111',
        ];

        $response = $this->call('PUT', '/loans/1', $data);
        $this->assertEquals(200, $response->status());
        $responseData = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('loan_title', $responseData);
        $this->assertEquals('Updated Loan 111', $responseData['loan_title']);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAllLoans()
    {
        $response = $this->call('GET', '/');

        $this->assertEquals(200, $response->status());
    }
    /**
     * Test retrieving a single loan.
     *
     * @return void
     */
    public function testGetSingleLoan()
    {
        // Assume there is a loan with id = 1 in the database
        $response = $this->call('GET', '/loans/1');

        $this->assertEquals(200, $response->status());
        $this->assertJson($response->getContent());
    }
    /**
     * Test deleting loan.
     *
     * @return void
     */

    public function testDeleteLoan()
    {
        $response = $this->call('DELETE', '/loans/5');
        $this->assertEquals(200, $response->status());
    }

}
