<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 6/6/2017
 * Time: 2:50 PM
 */

namespace vector\PMCAdapter;


use Author;

class ResultAdapter
{
    private $pmc_result_paper;
    private $parsed;

    function __construct( $pmc_result_paper )
    {
        $this->pmc_result_paper = $pmc_result_paper;
        $this->parsed = [
            "publication_date"  =>  $pmc_result_paper['pubdate'],
            "title"  =>  $pmc_result_paper['title'],
            "pages"  =>  $pmc_result_paper['pages'],
            "journal_name"  =>  $pmc_result_paper['fulljournalname'],
        ];

        foreach ( $pmc_result_paper['authors'] as $author ){
            $this->parsed['authors'][] = new PMCAuthor( $author['name'], $author['authtype'] );
        }
    }

    public function getTitle(){
        return $this->parsed['title'];
    }

    public function getPublicationDate(){
        return $this->parsed['publication_date'];
    }

    public function getJournalName(){
        return $this->parsed['journal_name'];
    }

    public function getAuthors(){
        return $this->parsed['authors'];
    }
}