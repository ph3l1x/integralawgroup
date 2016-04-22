<?php $requestUri = $_SERVER['REQUEST_URI']; ?>

<?php

	$pageNames = array("/business-planning-exit-strategies",

					   "/estate-planning-asset-protection",

					   "/attorney-bankruptcy-debt-relief");



?>

<div id="side_box">

	<?php if($requestUri == "/about") { ?>

		<h2>LEARN MORE</h2>

		<div id="fast_links">

			&raquo; <a href="#virtual_law">A New Kind Of Law Firm</a><br />

			&raquo; <a href="#legal_services">Protecting What's Important</a><br />

			&raquo; <a href="#experience">Experience You Can Trust</a>

		</div>

<? /* Ryan Edit */ ?>

  <?php } else if( strpos($requestUri, "healthcare-capital") ) { ?>

                <h2>LEARN MORE</h2>

                <div id="fast_links">

						 &raquo; <a href="#healthcare">Our Healthcare Practice</a><br />
                         &raquo; <a href="#detval">Determining Value</a><br />

                         &raquo; <a href="#prepmark">Preparing a Marketing Package</a><br />

                         &raquo; <a href="#findqual">Finding a Qualified Buyer</a><br />
                         &raquo; <a href="#negdeal">Negotiating the Deal</a><br />
                         &raquo; <a href="#priveq">Private Equity</a><br />


                </div>




        <?php } else if( strpos($requestUri, "selling_a_business") ) { ?>

                <h2>LEARN MORE</h2>

                <div id="fast_links">

                         &raquo; <a href="#professional_r">Professional Representation</a><br />

                         &raquo; <a href="#getting_d">Getting Deals Done</a><br />

                         &raquo; <a href="#innovative_s">Innovative Solutions</a><br />

<!--                         &raquo; <a href="#private_e">Private Equity</a><br />-->

                </div>



<? /* Ryan Edit End */ ?>

	<?php } else if( strpos($requestUri, "business-planning-exit-strategies") ) { ?>

		<h2>LEARN MORE</h2>

		<div id="fast_links">

			 &raquo; <a href="#ten_critical">Ten Critical Questions</a><br />

			 &raquo; <a href="#begin_with_the_end">Begin with the end in mind</a><br />

			 &raquo; <a href="#sole_proprietorship">Sole Proprietorship</a><br />

			 &raquo; <a href="#partnership">Partnership</a><br />

			 &raquo; <a href="#llc">Limited Liability Company</a><br />

			 &raquo; <a href="#corporation">Corporation</a><br />

			 &raquo; <a href="#buying_business">Buying a Business</a><br />

			 &raquo; <a href="#integra_legalcare">INTEGRA LegalCare</a>

		</div>

	<?php } else if( strpos($requestUri, "estate-planning-asset-protection") ) { ?>

		<h2>LEARN MORE</h2>

		<div id="fast_links">

			 &raquo; <a href="#ten_critical">Ten Critical Questions</a><br />

			 &raquo; <a href="#need_for_estate_planning">Why You Need an Estate Plan</a><br />

			 &raquo; <a href="#will">Preparing a Will</a><br />

			 &raquo; <a href="#living_trust">Advantages of a Living Trust</a><br />

			 &raquo; <a href="#durable_power_of_attorney">Durable Power of Attorney</a><br />

			 &raquo; <a href="#living_will">Living Will &amp; Health Care...</a><br />

			 &raquo; <a href="#long_term_care">Long Term Care</a><br />

			 &raquo; <a href="#qualifying_fot_medicaid">Qualifying for Medicaid</a><br />

		</div>

	<?php } else if( strpos($requestUri, "attorney-bankruptcy-debt-relief") ) { ?>

		<h2>LEARN MORE</h2>

		<div id="fast_links">

			 &raquo; <a href="#is_bankruptcy">Is bankruptcy the right choice?</a><br />

			 &raquo; <a href="#why_file_bankruptcy">The Purpose of Bankruptcy</a><br />

			 &raquo; <a href="#automatic_stay">Automatic Stay</a><br />

			 &raquo; <a href="#chapter7">Chapter 7</a><br />

			 &raquo; <a href="#chapter13">Chapter 13</a><br />

			 &raquo; <a href="#loan_modifications">Loan Modification</a><br />

			 &raquo; <a href="#stopping_a_foreclosure">Stopping a Foreclosure</a><br />

		</div>
        
        	<?php } else if( strpos($requestUri, "our_fees") ) { ?>

		<h2>LEARN MORE</h2>

		<div id="fast_links">

			&raquo; <a href="#virtual_law">A New Kind Of Law Firm</a><br />

			&raquo; <a href="#legal_services">Protecting What's Important</a><br />

			&raquo; <a href="#experience">Experience You Can Trust</a>

		</div>
        

	<?php } else if( strpos($requestUri, "contact-us") ) { ?>

		<h2>LEARN MORE</h2>

		<div id="fast_links">

			 &raquo; <a href="#">Contact us</a><br />

		</div>

	<?php } else { ?>

		<!--

		<h2><?php print $title?></h2>

		<div id="fast_links">

			<?php require_once('recent_posts.php'); ?>

			<div id="more"><a href="/blog/">more</a></div>

		</div>

		-->

	<?php } ?>	

</div>



<div id="links">


  <!-- Home Page Only -->
<?php if($_SERVER['REQUEST_URI'] == '/' || strpos($requestUri, "about")) { ?>
  <div class="bruceInfo">
	<img src="<?php print $themePath; ?>/images/Bruce_Perry.jpg">
	<div class="bruceText">
	  Integra Law Group is a new kind of law firm. We use technology and a virtual office environment to provide affordable legal services.
	  <div class="bruceLearnMore"><a href="/about-integra-law-group">» Learn More</a></div>
	</div>
  </div>

<?php } else { ?>



  <!-- Begin Video Library -->

	<ul id="accordion1" class="accordion">

		<li>

			<h3><img src="<?php echo $themePath; ?>/images/link_video_library.gif"width="200" height="36" alt="" class="link"/></h3>

			<div class="acc-section">

				<a href="/about-integra-law-group">&raquo; About Integra Law Group.</a>

                                <a href="/business-planning-video">&raquo; Begin With the End in Mind</a>

				<a href="/estate-planning-video">&raquo; A "Not So Simple" Estate Plan</a>

                                <!--a href="/bankruptcy-video">&raquo; A New Financial Beginning</a-->

                        </div>



		</li>

	</ul>

	<br />

	<a href="/request-free-planning-guide/"><img src="<?php echo $themePath; ?>/images/link_register_free_seminar.gif" width="200" height="36" alt="" class="link" /></a><br />

	<br />

	<?php if(false) { ?>

	<a href="http://www.integralawblog.com/" target="_blank"><img src="<?php echo $themePath; ?>/images/link_blog.gif" width="200" height="36" /></a>

<?php } ?>

<?php if(false) { ?>

	<ul id="accordion2" class="accordion">

		<li><h3><img src="<?php echo $themePath; ?>/images/link_blog.gif" width="200" height="36" alt="" /></h3>

			<div class="acc-section">

				<a href="/blog/business-planning">&raquo; Business Planning Blog</a>

				<a href="/blog/estate-planning">&raquo; Estate Planning Blog</a>

				<a href="/blog/bankruptcy">&raquo; Bankruptcy Blog</a>

			</div>

		</li>

	</ul>

<?php } ?>

<?php //if(false) { ?>

	<ul id="accordion2" class="accordion">

		<li><h3><img src="<?php echo $themePath; ?>/images/link_affiliate.gif" width="200" height="36" alt="" /></h3>

			<div class="acc-section">

				<a href="http://www.estateplanning-longtermcare.com/" target="_blank">&raquo; Estate Planning & Long Term Care</a>
                <a href="http://www.boise-bankruptcy-attorney.com/" target="_blank">&raquo; Bankruptcy Protection &amp; Debt Relief</a>
			</div>

		</li>

	</ul>



</div>



<script type="text/javascript">

	var accordion1 = new TINY.accordion.slider("accordion1");

	accordion1.init("accordion1","h3");



	var accordion2 = new TINY.accordion.slider("accordion2");

	accordion2.init("accordion2","h3");

</script>



<?php require_once('contact_us_form.php'); ?>

<?php } // end of if else statement for showing bruce's picture on about and home page. ?>

<!-- Bruce Perry Quote

		<p>You shouldn't have to forego critical legal advice or take a chance filling out legal forms you found on the internet because lawyers cost too much.</p>

		<p>We offer a better way. By utilizing technology and a virtual office environment, we provide legal services more efficiently. That saves you time and money. (And we like it better, too!)</p>

		<p>So contact us today; there's no charge for an initial consultation. We just want to be sure you get the professional advice you need.</p>

		<p>

			Bruce M. Perry<br />

			950 W. Bannock, 11th Floor<br />

			Boise, Idaho 83702<br />

			208.386.9000<br />

		</p>

-->



<h3 class="yellow">Client Experiences</h3>

<br />



<div id="rvtickerContent" onMouseover="rvt_copyspeed=rvt_pausespeed" onMouseout="rvt_copyspeed=rvt_tickerSpeed">

	<div id="rvtickerID">

		<hr color="#045371" size="1" />



		<p>

			A challenge to buying or selling a business is getting past the hurdles that appear along the way.

			Bruce Perry was successful at offering solutions that benefited both buyer and seller and kept the negotiations moving forward. 

		</p>

		<p>

			<strong>Clint Tate<br />

			President &amp; Owner<br />

			Enterprise Electric</strong>

		</p>



		<hr color="#045371" size="1" />



		<p>

			

				I want to thank Bruce Perry for all the hard work, advice and counseling he provided for me during the process of locating and buying a business. After thinking about the whole acquisition process, I think the smartest thing I did was to pay him a retainer to help me through the process.  I know I would never have completed the process without his help.

				Bruce Perry's ability to keep the negotiations going when both the seller and I were ready to throw in the towel was awesome!  I would not be where I am at today without having his experience, advice and business contacts to help me through the process.

			

		</p>

		<p>

			<strong>Marty Cullen<br />

			Owner,<br />

			A-1 Plumbing Services</strong>

		</p>



		<hr color="#045371" size="1" />



		<p>

			Bruce Perry recently represented me in the successful sale of my business during a an exceptionally difficult economic environment.

			I can truly say he brought a wealth of knowledge and experience to the table, which greatly facilitated a successful transaction.

		</p>

		<p>

			<strong>Steve Batten<br />

			Former Owner<br />

			Alloway Electric</strong>

		</p>



		<hr color="#045371" size="1" />



		<p>

			There are too many pitfalls when owning a business, planning an exit strategy, or putting together an estate plan not to have good advice.

			I am thankful for the wise counsel I have received from Bruce Perry from the day I began my business twenty-five years ago to my successful exit.

		</p>

		<p>

			<strong>Larry Laraway<br />

			Former Owner &amp; President<br />

			Coldwell Banker Aspen Realty</strong>

		</p>



		<hr color="#045371" size="1" />



		<p>

			Having good legal counsel representing you as you plan your future is critical.

			I have known and watched Bruce Perry for years, and his knowledge, professionalism, thoroughness, and honesty are second to none.

			You owe it to yourself to have him on your team.

		</p>

		<p>

			<strong>Clyde Brinegar<br />

			President<br />

			Business Development Network</strong>

		</p>



		<hr color="#045371" size="1" />



		<p>

			When faced with financial problems, it is imperative to be represented by good legal counsel.

			You need someone that has the knowledge, experience, and character to be sure you as well as your family are protected and to help you plan for the future.

			I have known Bruce Perry for over thirty years and highly recommend him.

		</p>

		<p>

			<strong>Kay Jewell<br />

			Retired School Teacher</strong>

		</p>

		<hr color="#045371" size="1" />

		<p>

			There are 3 "D"'s in business success: Develop, Delegate &amp; Disappear!

			I started A1 Plumbing Services twenty-five years ago with the full intent of eventually selling it.

			At age fifty-two, my goal was realized with the help of Bruce Perry in successfully putting a sale together.

		</p>

		<p>

			<strong>Dan Long<br />

			Founder &amp; Former Owner<br />

			A-1 Plumbing Services</strong>

		</p>

		

	</div>

</div>

