<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Location;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\TransportException;

class ScrapeFlights extends Command
{
    protected $signature = 'scrape:flights';
    protected $description = 'Scrape flight schedule data from Yemenia';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Starting the scraping process...');
        
        $client = HttpClient::create();

        try {
            $response = $client->request('GET', 'https://yemenia.com/flights-schedule');
            $html = $response->getContent();
            $this->info('Successfully fetched the flight schedule page.');
        } catch (ClientException $e) {
            $this->error('ClientException: ' . $e->getMessage());
            return;
        } catch (TransportException $e) {
            $this->error('TransportException: ' . $e->getMessage());
            return;
        } catch (\Exception $e) {
            $this->error('Exception: ' . $e->getMessage());
            return;
        }

        $crawler = new Crawler($html);

        // Extract 'From' locations with their values
        $fromLocations = $crawler->filter('select[name="from"] option')->each(function (Crawler $node) {
            return [
                'code' => $node->attr('value'),
                'name' => $node->text(),
            ];
        });
        $this->info('Extracted "From" locations.');

        // Extract 'To' locations with their values
        $toLocations = $crawler->filter('select[name="to"] option')->each(function (Crawler $node) {
            return [
                'code' => $node->attr('value'),
                'name' => $node->text(),
            ];
        });
        $this->info('Extracted "To" locations.');

        // Save locations to the database
        $this->saveLocations($fromLocations, 'from');
        $this->saveLocations($toLocations, 'to');

        $this->info('Flight data has been scraped and inserted into the database.');
    }

    protected function saveLocations(array $locations, string $type)
    {
        foreach ($locations as $location) {
            // Check if location is not empty
            if (!empty($location['name']) && !empty($location['code'])) {
                Location::updateOrCreate(
                    ['code' => $location['code']],
                    ['name' => $location['name'], 'type' => $type]
                );
                $this->info("Saved location: {$location['name']} ({$location['code']})");
            }
        }
    }
}
