<?php

class BggAPI_model
{
    private $bggBaseURI = 'https://www.boardgamegeek.com/xmlapi2/';
    
    public function search($query)
    {
        if ($query === null )
        {
            return false;
        }
        
        $apiRequest = $this->bggBaseURI . 'search?query=' . $query . '&type=boardgame';
        $ch = curl_init($apiRequest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $xmlString = curl_exec($ch);
        
        // return $xmlString;
        
        // Get the id of each item in the xmlString query result
        $xmlObject = simplexml_load_string($xmlString);

        /*$gamesById = array();
        foreach ($xmlObject->item as $item)
        {
            $gamesById[] = $item['id'];
        }*/
        
        foreach ($xmlObject->item as $item)
        {
            $itemAttributes[] = $item->attributes();
        }
        
        foreach ($itemAttributes as $attributeArray)
        {
            $gamesById[] = (int)$attributeArray['id'];
        }
        
        // return $gamesById;
        
        // Construct a new API call to get Things related to each id (single call) ABSTRACT INTO NEW FUNCTION
        $games = $this->getThings($gamesById);
        
        return $games;
        
    }
    
    /**
     * This method gets 'Thing'data from BGG api for each game in an array of game id's
     * 
     * @param $gamesById An array of game id's
     * @return an array of SimpleXMLElement Objects each representing a game.
     */
    private function getThings($gamesById = array())
    {
        $apiRequest = $this->bggBaseURI . 'thing?id=' . implode(',', $gamesById);
        $ch = curl_init($apiRequest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $xmlString = curl_exec($ch);
        $xmlObject = simplexml_load_string($xmlString);
        $thingArray = array();
        
        foreach ($xmlObject->item as $item)
        {
            $thingArray[] = $item;
        }

        return $thingArray;
    }
}

?>