<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use GuzzleHttp;

use Illuminate\Http\Exception\GuzzleException;
use GuzzleHttp\Client;

use App\Blog as Blog;
use App\User as User;
use App\SuggestedMechanics as SuggestedMechanics;

//Scrapping Tool
// use Goutte\Client;

class WebScrapper extends Controller
{
        /**
 * For scraping data for the specified collection.
 *
 * @param  string $collection
 * @return boolean
 */
	// public static function scrape($collection)
	// {
	// 	dd($collection);

	//     $crawler = Goutte::request('GET', env('FUNKO_POP_URL').'/'.$collection);

	//     $pages = ($crawler->filter('footer .pagination li')->count() > 0)
	//         ? $crawler->filter('footer .pagination li:nth-last-child(2)')->text()
	//         : 0
	//     ;

	//     for ($i = 0; $i < $pages + 1; $i++) {
	//         if ($i != 0) {
	//             $crawler = Goutte::request('GET', env('FUNKO_POP_URL').'/'.$collection.'?page='.$i);
	//         }

	//         $crawler->filter('.product-item')->each(function ($node) {
	//             $sku   = explode('#', $node->filter('.product-sku')->text())[1];
	//             $title = trim($node->filter('.title a')->text());

	//             print_r($sku.', '.$title);
	//         });
	//     }

	//     return true;
	// }

        public function scrape(){
		$client = new Client();
		// $crawlerTitle = $client->request('GET', 'https://vimfile.com/blog/2020/02/17/why-regular-vehicle-inspections-and-maintenance-are-important/');
		$crawlerTitle = $client->request('GET', 'https://soar.vimfile.com/');

		dd($crawlerTitle);

		   $title =  $crawlerTitle->filter('.entry-body .entry-content ol li');

			$i = 0;
			foreach ($title as $key) {
			$i = $i +1;

		   	//Get Unique Title
		   	$thistitle = $key->firstChild->firstChild->data;

		   	$valBody =  $crawlerTitle->filter('.entry-body .entry-content p');

			$j =0;
			foreach ($valBody as $body) {
			$j = $j +1;

		   		//Get Assumed Body
		   		$thisbody = $body->firstChild->data;

			   	//Insert This
			   	if($i == $j){
			   		// echo $thisbody."<hr />";
			   		Blog::updateOrCreate(['title' => $thistitle], ['body' => str_limit($thisbody, 240)]);
			   	}

		   	}


		   }

		   return 1;
	   }


	//    Get Long and Lat

	public function getAddressinfo(){
		// $user = User::where('address', '!=', null)->get();
		$user = SuggestedMechanics::where('address', '!=', null)->inRandomOrder()->take(200)->get();

		// dd($user);

		foreach($user as $key => $value){
			$address = $value->address;
			// $email = $value->email;
			$station_name = $value->station_name;

			$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&key=AIzaSyD7blqziwyJPZTh1v0it9Ct9wUq1qurpsA";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
			$responseJson = curl_exec($ch);
			curl_close($ch);

			$response = json_decode($responseJson);


			if ($response->status == 'OK') {

				$latitude = $response->results[0]->geometry->location->lat;
				$longitude = $response->results[0]->geometry->location->lng;

				// Update USer
				SuggestedMechanics::where('address', $address)->update(['lon' => $longitude, 'lat' => $latitude]);


				// echo 'Address: ' . $address;
				// echo '<br />';
				// echo 'Latitude: ' . $latitude;
				// echo '<br />';
				// echo 'Longitude: ' . $longitude;

				// echo '<hr />';

			} else {
				echo $response->status;
				var_dump($response);
			} 


		}

		Log::info('Cron executed'. date('d-m-Y h:i a'));
		 



	}

}
