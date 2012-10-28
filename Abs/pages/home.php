<?php if(!defined("WRAPPER")){ echo "You cannot load a page directly!"; exit; } ?>
<div id="tabbody">
    <div class="toolblock" style="display:none;"> 
        <img src="http://tools.computerfaq.be/public/media/layout/icons/compressed.png" alt="Zip icoon" />
        <h3><a href="http://tools.computerfaq.be/imagecompressor/">Image compressor</a></h3>
        <span>Het beste formaat voor je afbeeldingen</span> 
        <div class="new"><!----></div>
    </div>
    <div class="toolblock">
        <img src="images/archive.png" alt="Archive" />
        <span>create file backups</span>
        <h3>File backups</h3>
        <a href="?page=filebackup" class="button">Open</a>
    </div>
    
    <div class="toolblock">
        <img src="images/unarchive.png" alt="Deploy" />
        <span>upload an update</span>
        <h3>Deploy</h3>
        <a href="index.php?page=deploy" class="button">Open</a></div>
    
    <div class="toolblock">
        <img src="images/server.png" alt="Server" />
        <span>create database backups</span>
        <h3>Database backups</h3>
        <a href="index.php?page=database" class="button">Open</a>
    </div>
    <div class="toolblock">
        <img src="images/doc.png" alt="Server" />
        <span>import database file</span>
        <h3>Database importer</h3>
        <a href="index.php?page=import" class="button">Open</a>
    </div>
    <div class="toolblock">
        <img src="images/advanced.png" alt="Configure" />
        <span>configurate ABS application</span>
        <h3>Configuration</h3>
        <a href="index.php?page=config" class="button">Open</a>
    </div>
    <div class="toolblock"> 
        <img src="images/exit.png" alt="Exit" /> 
        <span>log me out</span>
        <h3>Logout</h3>
        <a href="index.php?page=logout" class="button">Open</a>
    </div>
	<div class="spacer"><!----></div>
</div>