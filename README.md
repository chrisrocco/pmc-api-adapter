PubMed Central API PHP Wrapper
=========================

<h3>So you dont have to think about it!</h3>
A straightforward, reliable, PHP wrapper for consuming the PubMed Central API.

How to Use
--------
<ol>
    <li><strong>Construct a PMCAdapter with your app's name and your support email</strong>
        <br/>
        <code>
            $adapter = new PMCAdapter( "your_app_name", "your_email" );
        </code>
    </li>
    <li><strong>Lookup an article by it's PMC-ID</strong>
        <br/>
        <code>
            $result = $adapter->lookupPMCID( 3539452 );
        </code>
    </li>
    <li><strong>Interact with the data through the <em>ResultAdapter object</em></strong>
        <br/>
        <code>
            $result->getTitle();
            <br/>
            $result->getAuthors();
            <br/>
            $result->getPublicationDate();
            <br/>
            $result->getJournalName();
        </code>
    </li>
</ol>

<h3> Not enough functionality? </h3>
<h6> We've only included what was applicable to another project, but all of our
packages are designed for easy scaling.</h6>

<h6> Feel free to add functionality for your project, just make sure to
send a pull request when you're done! </h6>