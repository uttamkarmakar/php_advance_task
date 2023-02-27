<?php
  //Importing the vendor to use Guzzle HTTP client.
  require_once "./vendor/autoload.php";

  //Using GuzzleHttp class from the vendor folder.
  use GuzzleHttp\Client;

  define("string","https://ir-dev-d9.innoraft-sites.com");
class FetchData {
  /**
   * @var $title
   *  Storing the heading which is fetched from json.
   * @var $title_value
   *  Storing the value under a specific title.
   * @var $ImageSource
   *  Storing images which is fetched from API.
   * @var $exploreLink
   *  Storing the anchor tags names explore now.
   */
  public $title;
  public $title_value;
  public $ImageSource;
  public $exploreLink;
}

/**
 * PutData - Contains two methods which is use to convert json data to php array
 * and another method returns a arrays consists of objects.
 * 
 * @author Uttam Karmakar
 * @method FetchJsonData()
 *  This method converts the json data to a php array.
 * @method FetchJsonContent()
 *  Storing all the field_services value except which are NULL into an array.
 */
class PutData {
  public $dataArray = array();
  /**
   * Converts all the Json url to php form
   * 
   * @param string $url
   *  Url of data from API.
   * 
   * @return array
   */
  public function FetchJsonData($url) {
    $client = new Client();
    $response = $client->get($url);
    $json = $response->getBody()->getContents();
    $data = json_decode($json, TRUE);
    return $data;
  }

  /**
   * Stroing all the data from the API except which has NULL value in the field_services
   * and returns an array consist of those value as objects
   * 
   * @return array
   *  Returns array of objects
   */
  
  public function FetchJsonContent() {
    for ($i = 0; $i < 16; $i++) {
      $objData = new FetchData();
      $url = 'https://ir-dev-d9.innoraft-sites.com/jsonapi/node/services';
      $data = $this->FetchJsonData($url);
      $field_services = ($data['data'][$i]['attributes']['field_services']);
      
      //If the field_services section is NULL then skip that data.
      if ($field_services != NULL) {
        $objData->title = $data['data'][$i]['attributes']['title'];
        $objData->title_value = ($data['data'][$i]['attributes']['field_services']['processed']);
        $image = $data['data'][$i]['relationships']['field_image']['links']['related']['href'];
        $image_data = $this->FetchJsonData($image);
        $objData->ImageSource = constant("string") . $image_data['data']['attributes']['uri']['url'];
        $objData->exploreLink = constant("string") . $data['data'][$i]['attributes']['path']['alias'];
        array_push($this->dataArray, $objData);
      }
    }
    return $this->dataArray;
  }
}
