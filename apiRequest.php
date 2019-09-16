<?php 

class apiRequest {

    public function getData() 
    {
        
        $rules = explode(',', $_GET['values']);

        array_walk(
            $rules,
            function(&$value, &$key) {
                if($key != "0") {
                    $value = '&'.$value;
                }
            } 
        );

        $params = "q=";

        foreach($rules as $rule) {
            $params = $params.$rule;
        }

        $value = (int) $_GET['value'];
        $url = "https://api.github.com/search/repositories?".$params;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'User-Agent: Sasha_Zag',
        ));
        $result = curl_exec($curl);
        $data = json_decode($result, true);
        $repos = $data['items'];

        foreach ($repos as $repo) {
            echo "Owner " . $repo['owner']['login'];
            echo "<br />";
            echo "Owner url " . $repo['owner']['url'];
            echo "<br />";
            echo "Repos list " . $repo['owner']['repos_url'];
            echo "<br />";
            echo "Size " . $repo['size'];
            echo "<br />";
            echo "Forks count " . $repo['forks_count'];
            echo "<br />";
            echo "Followers " . $repo['watchers_count'];


        }

    }


}

$process = new apiRequest;
$process->getData();