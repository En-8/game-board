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
        
        // Get the id of each item in the xmlString query result
        $xmlObject = simplexml_load_string($xmlString);
        if ($xmlObject->attributes()['total']->__toString() == 0)
        {
            return false;
        }
        
        foreach ($xmlObject->item as $item)
        {
            $itemAttributes[] = $item->attributes();
        }
        
        foreach ($itemAttributes as $attributeArray)
        {
            $gamesById[] = (int)$attributeArray['id'];
        }
        
        // Construct a new API call to get Things related to each id (single call)
        $games = $this->getThings($gamesById);
        
        return $games;
        
    }
    
    /**
     * This method gets 'Thing' data from BGG api for each game in an array of game id's
     * 
     * @param $gamesById An array of game id's
     * @return an array of SimpleXMLElement Objects each representing a game.
     */
    public function getThings($gamesById = array())
    {
        $apiRequest = $this->bggBaseURI . 'thing?id=' . implode(',', $gamesById);
        $ch = curl_init($apiRequest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $xmlString = curl_exec($ch);
        $xmlObject = simplexml_load_string($xmlString);
        $thingArray = array();
        

        foreach ($xmlObject->item as $item)
        {
            $id = $item->attributes()->id->__toString();
            $thingArray[$id] = $item;
        }

        return $thingArray;
    }
    
    public function fetchCollection($username)
    {
        $apiRequest = $this->bggBaseURI . 'collection?username=' . $username;
        $ch = curl_init($apiRequest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $xmlString = curl_exec($ch);
        
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if ($httpCode == 202)
        {
            while ($httpCode == 202)
            {
                sleep(5);
                $xmlString = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            }
        }
        
        if ($httpCode == 200)
        {
            $xmlObject = simplexml_load_string($xmlString);
        
            return $xmlObject;
        }
        else
        {
            return false;
        }
        
        
    }
}

?>