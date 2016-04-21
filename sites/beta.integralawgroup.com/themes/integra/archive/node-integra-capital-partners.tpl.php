<?php
// $Id: page.tpl.php,v 1.28 2008/01/24 09:42:52 goba Exp $
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
<head>
  <title><?php print $head_title ?></title>
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyle Content in IE */  ?> </script>
  

<!--[if IE]>
<style type="text/css" media="all">.borderitem {border-style:solid;}</style>
<![endif]-->
</head>

<body>

<div id="main">
	<div class="rowWrap" >
		<div id="contentlogo">
        <a href="http://integralawgroup.com">
        <img src="<?php global $base_path; print $base_path.path_to_theme(); ?>/images/contentlogo.jpg" width="312" height="124" alt="Welcome to Integra Law Group" />
        </a>
		</div>
		<div id="content-tophead">


             <div class="top-menu">    
<ul class="links top-links">
<li class="menu-209 first active">
<a href="http://integralawgroup.com/user" title="" class="active">Client Login</a></li>
<li class="menu-211"><a href="http://integralawgroup.com/contact" title="">Contact Us</a></li>
</ul>   
			</div>
        
        
		</div>
	</div>
	<div id="contentmenu">
    
    
    
        <!-- menu start -->

                                    <?php // if (isset($primary_links)) : ?>
    
    							<div class="pr-menu">		
                                	
                                       
<ul class="links primary-links">
<li class="menu-115 first"><a href="http://integralawgroup.com/innovative-legal-services">Innovative Legal<br /> Services</a></li>
<li class="menu-115 first"><a href="http://integralawgroup.com/buying-business">Starting or Buying <br />a Business</a></li>
<li class="menu-115 first"><a href="http://integralawgroup.com/managing-business">Legal V.P<br />Service</a></li>
<li class="menu-115 first"><a href="http://integralawgroup.com/selling-business">Selling a <br />Business</a></li>
<li class="menu-115 first"><a href="http://integralawgroup.com/preparing-will-or-trust-0">Preparing a <br />Will or Trust</a></li>
<li class="menu-115 first"><a href="http://integralawgroup.com/getting-divorce">Getting a <br />Divorce</a></li>
<li class="menu-115 first"><a href="http://integralawgroup.com/obtaining-relief-debt">Obtaining <br />Debt Relief</a></li>
<li class="menu-115 first"><a href="http://integralawgroup.com/content/integra-capital-partners">Integra <br />Capital Partners</a></li>
</ul>  
                                      
                                            <?php //print theme('links', $primary_links, array('class' => 'links primary-links')) ?>
                                          
                                     


                                </div>      
            
                                    <?php //endif; ?>
          <!-- menu end -->
    
    
	</div>

	<div class="rowWrap" >
    

       	<div id="container">

        <div id="two-columns">
		 
        <div id="column-2">
        


      		        <!-- main content start -->
        
                        <div class="box-cont">
                        
                    
                        
                        

  <?php if ($breadcrumb): ?>
          <div id="breadcrumb">
            <?php print $breadcrumb; ?>
          </div><!-- /breadcrumb -->
  <?php endif; ?>
          
          
          

          
          
          

                        	<div id="headpic2">
                            
                            <div id="headpic_txt">
                            Integra Capital Partners1
<br />
                            </div>
                            
							</div>
                              <div class="clr"></div> 
<br>                        
<p>
Waqas this is new page <br />
Integra Capital Partners, LLC, (the “Company”) is a newly organized Idaho limited liability company that is being formed to acquire privately owned businesses, primarily in the Pacific Northwest.  The Company intends to acquire established businesses that have a history of profitability with the objective of providing both current income as well as long term appreciation to its investors.
</p>
<br>
<p>
The Company anticipates that target acquisitions will generally have the following characteristics: 
</p>
<br>
<p>

•	Established business with history of profitability
•	Sales ranging from $2 million to $10 million
•	Cash flow of between $200 thousand and $1 million
•	Proven business model
•	Experienced key employees
•	Long-term growth potential
•	Significant market share
•	Diverse customer base
</p>
<br>
<p>

The Company will not invest in start-ups, turnarounds or companies dependent on new technology.  Rather, the Company’s goal is to build upon and improve the operations of successful businesses.  Further, the Company intends to finance each acquisition substantially with equity from its investors.  Debt financing will generally be limited to equipment financing, working capital needs, and possibly some seller financing.  It is expected that investments will be held for between five and ten years, at which time the business will be sold or recapitalized so that investors will have an exit strategy.
</p>
<br>
<p>

The Company intends to acquire a controlling interest in each acquisition, preferably with the selling owner retaining an equity interest in and continuing to be involved with the business for a transition period.  The Company will select a successor to the selling owner.  This might be an existing key employee or an experienced manger recruited from outside the business.  The Company will encourage this person to make an equity investment in the business.

</p>
<br>



             


           
         		      </div>              
 	       
		        <!-- main content end -->      
        


                        
                        


		</div>
        
        
        
        
        
        
        
        
        
        
     		<div id="column-1">
  
        
        
<!-- nav start -->        
        
<!--        
        <div class="block block-user" id="block-user-1">
	<div class="block-top"></div>
    <div class="bg-block">
        <div class="bg-block-top">
            <div class="title">
                <h3>Navigation</h3>
            </div>
            <div class="content"><ul class="menu"><li class="leaf first"><a href="/drupal_22436/?q=node" title="" class="active">Home</a></li>
<li class="leaf"><a href="/drupal_22436/?q=forum" title="">Our Forum</a></li>
<li class="leaf"><a href="/drupal_22436/?q=node/8" title="">News</a></li>
<li class="leaf"><a href="/drupal_22436/?q=node" title="" class="active">Blog</a></li>
<li class="leaf"><a href="/drupal_22436/?q=node/8" title="">Solutions</a></li>
<li class="leaf"><a href="/drupal_22436/?q=node/8" title="">Book</a></li>
<li class="leaf"><a href="/drupal_22436/?q=search" title="">Advanced search</a></li>
<li class="leaf"><a href="/drupal_22436/?q=node/8" title="">FAQ&#039;s</a></li>
<li class="leaf"><a href="/drupal_22436/?q=contact" title="">Contact Us</a></li>
<li class="leaf last"><a href="/drupal_22436/?q=tracker">Recent posts</a></li>
</ul></div>
        </div>
    </div>
    <div class="block-bot"></div>
</div>
 -->
 
         <!-- side menu content start -->

<!--
<center>
<br /><br />
<a href="http://integralawgroup.com/content/integra-capital-partners"><img src="<?php // global $base_path; print $base_path.path_to_theme(); ?>/images/integra_cp.jpg" width="210" height="62" alt="Integra Capital Partners" /></a>
</center>
-->

<div class="left-box-cont">
<p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.......
<br />
 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.
 <br />

</p>
</div>
 <?php print $left ?>

        <!-- side menu content end -->        
        
        
<!-- nav end -->                
        
        
        
        
        
        
		</div>   
        
        
        
        
        
        
        
        
        
  <div class="clr"></div>       
				</div>
                </div>        
        
        
        
	</div>
	<div id="contentfooter">
    
                         <div class="box-cont-footer">
&copy; 2009 Integra Law Group. All Rights Reserved.<br />


         <?php if (isset($secondary_links)) { ?><?php print theme('links', $secondary_links, array('class' => 'links', 'id' => 'subnavlist')) ?><?php } ?>
         
         
         
         
         


              			 </div>
    
    
    
	</div>
</div>


</body>
</html>

