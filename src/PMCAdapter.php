<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 6/6/2017
 * Time: 2:50 PM
 */

namespace vector\PMCAdapter;


class PMCAdapter
{
    const NOT_FOUND = 7;
    const INVALID_ID = 14;
    const BAD_REQUEST = 28;
    const ERROR = 56;
    const SUCCESS = 112;

    const API_ENDPOINT = "https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esummary.fcgi";
    const DEFAULT_PARAMS = [
        "db=pmc",
        "retmode=json",
    ];
    private $application_params;

    function __construct( $application_name, $maintainer_email )
    {
        $this->application_params[] = "tool=$application_name";
        $this->application_params[] = "email=$maintainer_email";
    }

    function lookupPMCID( $pmcID ){
        $this->last_call_status = self::ERROR;
        $params_arr = array_merge( self::DEFAULT_PARAMS, $this->application_params, [ "id=$pmcID" ] );
        $params_str = implode( "&", $params_arr );

        $pmc_response = file_get_contents( self::API_ENDPOINT . "?" . $params_str );
        $pmc_response_arr = json_decode( $pmc_response, true);

        if( !isset($pmc_response_arr['result']) ) return self::BAD_REQUEST;
        if( isset($pmc_response_arr['error']) ) return self::INVALID_ID;

        $paper_data = $pmc_response_arr['result'][$pmcID];

        if( isset($paper_data['error']) ) return self::NOT_FOUND;

        $this->last_call_status = self::SUCCESS;
        return new ResultAdapter( $paper_data );
    }

    private $last_call_status;
    function wasSuccessful(){
        return ( $this->last_call_status == self::SUCCESS );
    }
}