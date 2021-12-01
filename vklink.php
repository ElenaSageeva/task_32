<?php

    $clientID = '';
    $clientSecret = '';
    $redirectURI = 'http://security/auth/oauth.php';
    $responseType = 'code';
    $display = 'page';
    $version = '5.131';
    $scope = 'offline';

    $params = [
        'client_id' => $clientID,
        'redirect_uri' => $redirectURI,
        'response_type' => $responseType,
        'v' => $version,
        'display' => $display,
        'scope' => $scope
    ];