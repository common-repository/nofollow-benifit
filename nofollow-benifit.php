<?php

/*
Plugin Name: Nofollow Benifit
Plugin URI: 
Description: This plugin is no longer maintained.
Author: podz
Version: 1.0
Author URI: 
*/



/*	Copyright 2005	Mark Jaquith (email: mark.gpl@txfx.net)
   Additional changes Copyright 2007 Ken Yasumoto-Nicolson (email: seron@whatjapanthinks.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

$wp_nr_footer_link = 0;//change to 0 to remove the 'Improve the web...' link



function wp_get_domain_name_from_uri($url){
//	preg_match("/^(http:\/\/)?([^\/]+)/i", $uri, $matches);
//	$host = $matches[2];
//	preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
//	return $matches[0];	   
	if(@stristr($url,'http')!=$url)$url = 'http://'.$url;
	if(substr_count($url,'/')<3)$url .= '/';	
	$domain = substr($url,strpos($url,'//')+2,(strpos($url,'/',10)-strpos($url,'//')-2));
	$domain_elements = explode('.',$domain);
	array_pop($domain_elements); //the last element is never the value you want
	$domainname = array_pop($domain_elements);
	if($domainname == "co") $domainname = array_pop($domain_elements);
	$domain = strtolower(@stristr($domain,$domainname));
	return $domain;
}

function wp_has_no_rel_nofollow($text)
{
	if ( preg_match("/rel=[\"\'].*?nofollow.*?[\"\']/i", $text ) )
		return false;
	else
		return true;
}

function wp_inarray($needle, $array, $searchKey = false)
{
   if ($searchKey) {
       foreach ($array as $key => $value)
           if (@stristr($key, $needle)) {return $key;}
       }
   else {
       foreach ($array as $value)
           if (@stristr($value, $needle)) {return $value;}
       }
   return '';
}

function parse_nofollow_Benifit($matches)
{
	//add in next line's array sites that you think do not deserve credit because they don't give it to other sites.
	if ( 	wp_inarray(wp_get_domain_name_from_uri($matches[3]), array("123greetings.com",
"18onlygirls.com",
"18yearsold.com",
"40somethingmag.com",
"89.com",
"aa.com",
"aaa.com",
"aarp.org",
"aavalue.com",
"abcsearch.com",
"about.com",
"accountonline.com",
"accuweather.com",
"acer.com",
"addictinggames.com",
"addresses.com",
"adicio.com",
"adobe.com",
"adtrgt.com",
"adult-empire.com",
"adult.com",
"adultbouncerhost.com",
"adultelite.com",
"adultfriendfinder.com",
"aebn.net",
"aetna.com",
"agoramedia.com",
"airtran.com",
"alibaba.com",
"allexperts.com",
"allinternal.com",
"allposters.com",
"allrecipes.com",
"alltel.com",
"alot.com",
"amateurallure.com",
"amateurmatch.com",
"amazon.co.uk",
"amazon.com",
"ambrosiasw.com",
"americanexpress.com",
"americangreetings.com",
"amtones.com",
"amtrak.com",
"ancestry.com",
"angelfire.com",
"annualcreditreport.com",
"answers.com",
"anywho.com",
"aol.com",
"ap.org",
"apartments.com",
"apcgalleries.com",
"apmhostedgalleries.com",
"apple.com",
"apply2jobs.com",
"areaconnect.com",
"areaguides.net",
"army.mil",
"art.com",
"artistdirect.com",
"ask.com",
"askmen.com",
"associatedcontent.com",
"asstraffic.com",
"atomz.com",
"att.com",
"att.net",
"auctionads.com",
"auctiva.com",
"autobytel.com",
"autoextra.com",
"automotive.com",
"autopartswarehouse.com",
"autotrader.com",
"autozone.com",
"avis.com",
"avon.com",
"avsystemcare.com",
"away.com",
"aweber.com",
"awempire.com",
"azcentral.com",
"aziani.com",
"azlyrics.com",
"babes.tv",
"babycenter.com",
"badgirlpotd.com",
"bangbros.com",
"bangbrosnetwork.com",
"bankofamerica.com",
"bankrate.com",
"barnesandnoble.com",
"basspro.com",
"bbc.co.uk",
"bcash4you.com",
"become.com",
"bedbathandbeyond.com",
"beliefnet.com",
"bellsouth.com",
"bellsouth.net",
"berkeley.edu",
"best-price.com",
"bestbuy.com",
"bestcoolindividuals.com",
"bestfreerewards.com",
"bestfuckvids.com",
"bestunbeatableoffer.com",
"bet.com",
"beyond.com",
"bhg.com",
"bid4prizes.com",
"bidz.com",
"bigboobdreams.com",
"bigtimecrush.com",
"bigtitsroundasses.com",
"bigwin.com",
"billerweb.com",
"bizrate.com",
"blingbucks.com",
"blockbuster.com",
"blogger.com",
"blogs.com",
"blogspot.com",
"bluemountain.com",
"blurtit.com",
"bmgmusic.com",
"bookrags.com",
"bordersmedia.com",
"bordersstores.com",
"boston.com",
"brassring.com",
"brazzers.com",
"break.com",
"britannica.com",
"budget.com",
"business.com",
"businessweek.com",
"buy.com",
"buycostumes.com",
"buzznet.com",
"ca.gov",
"ca.us",
"cabelas.com",
"cafepress.com",
"calibex.com",
"callwave.com",
"camcrush.com",
"cams.com",
"capitalone.com",
"careerbuilder.com",
"carfax.com",
"carmax.com",
"cars.com",
"carsdirect.com",
"cartoonnetwork.com",
"cataloglink.com",
"cbs.com",
"cbsnews.com",
"ccgals.com",
"ccleaner.com",
"cdc.gov",
"cdkitchen.com",
"cduniverse.com",
"charter.net",
"chase.com",
"cheapflights.com",
"cheapoair.com",
"cheaptickets.com",
"cheatcc.com",
"cheetahmail.com",
"chevrolet.com",
"choicehotels.com",
"christianbook.com",
"chtah.com",
"circuitcity.com",
"citibank.com",
"citicards.com",
"city-data.com",
"citysearch.com",
"classmates.com",
"clearchannel.com",
"clickshield.net",
"cnet.com",
"cnn.com",
"cnomy.com",
"columbiahouse.com",
"com.com",
"comcast.com",
"comcast.net",
"completealbumlyrics.com",
"constantcontact.com",
"consumergain.com",
"consumerincentiverewards.com",
"consumerreports.org",
"consumersearch.com",
"continental.com",
"convergentcare.com",
"cooks.com",
"coolsavings.com",
"copeac.com",
"corel.com",
"cornell.edu",
"corsis.com",
"costco.com",
"countrywide.com",
"coupons.com",
"courseadvisor.com",
"cox.com",
"cox.net",
"craigslist.org",
"cstv.com",
"cubpack81.com",
"custhelp.com",
"cvs.com",
"dada.net",
"dadamobile.com",
"daddysfriend.com",
"dawsonmiller.com",
"ddfcash.com",
"dealtime.com",
"dedge.com",
"deecash.com",
"degreeusa.com",
"dell.com",
"delta.com",
"deviantart.com",
"dexknows.com",
"dickssportinggoods.com",
"digg.com",
"digitalmoses.com",
"directaclick.com",
"directv.com",
"discovercard.com",
"discovercardapplication.com",
"discovery.com",
"dishnetwork.com",
"dmv.org",
"doctorassmaster.com",
"dogpile.com",
"dominos.com",
"donotcall.gov",
"download.com",
"drivelinemedia.com",
"drugs.com",
"drugstore.com",
"dubinterviewer.com",
"dutchteengalleries.com",
"dvdbox.com",
"earthlink.net",
"easygals.com",
"ebay.com",
"ecnext.com",
"ed.gov",
"edmunds.com",
"eharmony.com",
"ehow.com",
"elephantlist.com",
"emediate.eu",
"emedicinehealth.com",
"emusic.com",
"enchantedlearning.com",
"enterprise.com",
"entertainment.com",
"eonline.com",
"epinions.com",
"eprize.net",
"equifax.com",
"eroticlick.net",
"erotiqlinks.com",
"esecureorder.com",
"especialads.com",
"essortment.com",
"estara.com",
"eversave.com",
"everydayhealth.com",
"everythinggirl.com",
"evite.com",
"expedia.com",
"experian.com",
"exploitedteens.com",
"exxxtrememovie.com",
"ezinearticles.com",
"facebook.com",
"fandango.com",
"fark.com",
"fastweb.com",
"fatwallet.com",
"favorite.com",
"fda.gov",
"fedex.com",
"feedroom.com",
"fetchback.com",
"fetishhitsgallery.com",
"fhpicturegalleries.com",
"fidelity.com",
"findarticles.com",
"findlaw.com",
"findlinks.com",
"findlongevitynow.com",
"findstuff.com",
"findtherightschool.com",
"finesearch.org",
"firstceleb.com",
"firstusa.com",
"fl.us",
"flickr.com",
"fling.com",
"flixster.com",
"fluxads.com",
"flycell.com",
"foodnetwork.com",
"forbes.com",
"fordvehicles.com",
"foreseeresults.com",
"fortunecity.com",
"fotosearch.com",
"fox.com",
"foxnews.com",
"foxsports.com",
"freaksofcock.com",
"freeclipoftheday.com",
"freecodesource.com",
"freecreditreport.com",
"freefind.com",
"freehostedpics.com",
"freehotzone.com",
"freemyspacebackgrounds.com",
"freeones.com",
"freepagegraphics.com",
"freepatentsonline.com",
"freeporn-mpegs.com",
"freepornlessons.com",
"freepornofiles.com",
"freepornofreeporn.com",
"freevideogallery.com",
"freeweblayouts.net",
"freewebs.com",
"freeze.com",
"ftc.gov",
"ftd.com",
"ftvcash.com",
"fuckingmachines.com",
"funbrain.com",
"fvotd.com",
"gallerieshd.com",
"galleryhost.com",
"gamefaqs.com",
"gamespot.com",
"gamesradar.com",
"gamestop.com",
"gap.com",
"gateway.com",
"geico.com",
"generousgenie.com",
"geoaccess.com",
"geocities.com",
"gevalia.com",
"giftfreebies.com",
"giftitamerica.com",
"gigagalleries.com",
"gizmodo.com",
"glamagic.com",
"go.com",
"godaddy.com",
"gofreecredit.com",
"google.com",
"googlepages.com",
"greatschools.net",
"grisoft.com",
"guardian.co.uk",
"hallmark.com",
"hardcorehotties.com",
"harvard.edu",
"hasbro.com",
"healthline.com",
"heavy.com",
"hgtv.com",
"hi5.com",
"highbeam.com",
"hilton.com",
"hoes.com",
"hollywood.com",
"homedepot.com",
"homegain.com",
"homestead.com",
"honda.com",
"hornymatches.com",
"hostave3.net",
"hostave4.net",
"hotbods.com",
"hotels.com",
"hotfreelayouts.com",
"hotornot.com",
"hotwire.com",
"housewife1on1page.com",
"howstuffworks.com",
"hp.com",
"hrsaccount.com",
"hsbcbillpay.com",
"hsbccreditcard.com",
"hsn.com",
"huffingtonpost.com",
"hugefreevids.com",
"hundiesgalleries.com",
"iagals.com",
"icbdr.com",
"ichotelsgroup.com",
"icims.com",
"icio.us",
"iconadserver.com",
"ifgirls.com",
"ifriends.net",
"ign.com",
"iinet.net.au",
"ikea.com",
"il.us",
"images-amazon.com",
"imageshack.us",
"imagevenue.com",
"imdb.com",
"imeem.com",
"imlive.com",
"incrediblecontent.com",
"indeed.com",
"info.com",
"infonow.net",
"infoplease.com",
"information.com",
"infospace.com",
"ingdirect.com",
"inq.com",
"insiderpages.com",
"insightexpress.com",
"installshield.com",
"insureme.com",
"insweb.com",
"intelius.com",
"intellitxt.com",
"interclick.com",
"internetopiniongroup.com",
"irs.gov",
"istockphoto.com",
"itt-tech.edu",
"ivanafukalot.com",
"ivillage.com",
"iwon.com",
"jack9.com",
"jamster.com",
"java.com",
"jcpenney.com",
"jcwhitney.com",
"jetblue.com",
"jetblueairways.com",
"jibjab.com",
"jimmydiamond.com",
"job.com",
"jobsonline.net",
"jointheporn.com",
"joypeaceandhappiness.com",
"juggcrew.com",
"justanswer.com",
"justclicklocal.com",
"justcreampie.com",
"justfreeporn.com",
"kaboodle.com",
"kbb.com",
"kidshealth.org",
"kijiji.com",
"kinghost.com",
"kmart.com",
"know-where.com",
"kodak.com",
"kodakgallery.com",
"kohls.com",
"kolmic.com",
"kotaku.com",
"kraftfoods.com",
"landsend.com",
"latimes.com",
"legacy.com",
"lendingtree.com",
"letstalk.com",
"lifehacker.com",
"lifescript.com",
"limewire.com",
"linkedin.com",
"literotica.com",
"littlethumbs.com",
"live.com",
"livejasmin.com",
"livejournal.com",
"liveleak.com",
"liveperson.net",
"llbean.com",
"loc.gov",
"local.com",
"longestlist.com",
"looksmart.com",
"lowermybills.com",
"lowes.com",
"lowpriceshopper.com",
"lycos.com",
"lyrics.com",
"m-w.com",
"mac.com",
"macromedia.com",
"macrumors.com",
"macys.com",
"maniacpass.com",
"maniacworld.com",
"manta.com",
"mappoint.net",
"mapquest.com",
"marchex.com",
"marketwatch.com",
"marriott.com",
"marthastewart.com",
"massivegalleries.com",
"match.com",
"mate1.com",
"mature.nl",
"maximonline.com",
"maxpreps.com",
"maxxandmore.com",
"mayoclinic.com",
"mbnanetaccess.com",
"mcafee.com",
"mcdonalds.com",
"mcssl.com",
"meanwhile.com",
"meatgalleries.com",
"medcohealth.com",
"medhelp.org",
"medicinenet.com",
"membershipme.com",
"memoriter.net",
"merriam-webster.com",
"met-art.com",
"metacafe.com",
"metrolyrics.com",
"mi.us",
"michigan.gov",
"microsoft.com",
"milfcash.com",
"military.com",
"miniclip.com",
"mininova.org",
"misterstiff.com",
"mlb.com",
"mn.us",
"mobularity.com",
"mobularity.net",
"modpath.com",
"monalisas.com",
"mondominishows.com",
"monster.com",
"monstermarketplace.com",
"move.com",
"moviemonster.com",
"movieroom.com",
"movietickets.com",
"mozilla.com",
"mrskin.com",
"msn.com",
"mtv.com",
"mybluelight.com",
"mycheckfree.com",
"mycokerewards.com",
"myexclusiverewards.com",
"myfirstsexteacherpage.com",
"myfreepaysite.com",
"myfriendshotmompage.com",
"mygirlyspace.com",
"myhotcomments.com",
"myluvcrush.com",
"mynortonaccount.com",
"mypoints.com",
"myrecipes.com",
"mysanantonio.com",
"mysistershotfriendgallery.com",
"mysite.com",
"myspace.com",
"mysurvey4u.com",
"myway.com",
"mywebsearch.com",
"myyearbook.com",
"nadaguides.com",
"nakedgfs.com",
"nasa.gov",
"nascar.com",
"nationalgeographic.com",
"nationalsurveypanel.com",
"naughtyamericavippage.com",
"naughtyathome.com",
"naughtybank.com",
"naughtybookwormpage.com",
"naughtyofficegallery.com",
"navy.mil",
"nba.com",
"nbc.com",
"nbcuni.com",
"nc.us",
"ndparking.com",
"netflix.com",
"netquote.com",
"netzero.net",
"newcarinsider.com",
"news.com.au",
"nextag.com",
"nextel.com",
"nfl.com",
"nichedsites.com",
"nick.com",
"nickjr.com",
"nih.gov",
"nike.com",
"nissanusa.com",
"nj.us",
"noaa.gov",
"nobelprize.org",
"nordstrom.com",
"northerntool.com",
"npr.org",
"nps.gov",
"nsgalleries.com",
"nshoneys.com",
"nubiles.net",
"nwa.com",
"ny.us",
"nyadmcncserve-05y06a.com",
"nytimes.com",
"octopusgalls.com",
"ocxxx.com",
"officedepot.com",
"officemax.com",
"oh.us",
"oldnavy.com",
"one-time-offer.com",
"onlinecreditcenter6.com",
"onlinegiftrewards.com",
"onlinerewardcenter.com",
"onyxvisa.com",
"opm.gov",
"oprah.com",
"orbitz.com",
"orchardbank.com",
"orientaltrading.com",
"ourfreegalleries.com",
"overstock.com",
"ownbox.com",
"pa.us",
"pantyhosetoday.com",
"papajohns.com",
"papajohnsonline.com",
"paperstreetcash.com",
"parents.com",
"partstore.com",
"partycity.com",
"passport.net",
"paypal.com",
"pbase.com",
"pbs.org",
"pbskids.org",
"pch.com",
"pcprivacytool.com",
"pctools.com",
"pcworld.com",
"people.com",
"peopleclick.com",
"peoplefinders.com",
"peoplelookup.com",
"peoplepc.com",
"perfectgonzo.com",
"perfectlovercalculator.com",
"petfinder.com",
"phoenixdegrees.com",
"photobucket.com",
"pichunter.com",
"pimp-my-profile.com",
"pimpfreepics.com",
"pimproll.com",
"pizzahut.com",
"playaudiomessage.com",
"pogo.com",
"popularscreensavers.com",
"porn-o-rama.com",
"porn-x-videos.com",
"pornaccess.com",
"pornsitejourney.com",
"premiumpass.com",
"prettypussies.com",
"pricegrabber.com",
"priceline.com",
"primosearch.com",
"projectplaylist.com",
"pronto.com",
"propeller.com",
"prweb.com",
"public-records-now.com",
"purdue.edu",
"pussy.org",
"pyzam.com",
"quantcast.com",
"quizrocket.com",
"qvc.com",
"qwest.com",
"radioshack.com",
"rapidshare.com",
"rcn.com",
"real.com",
"realage.com",
"realarcade.com",
"realexgirlfriends.com",
"realhotsex.com",
"realitykings.com",
"realitypornguys.com",
"realitypornkings.com",
"realsexcash.com",
"realtechnetwork.net",
"realtor.com",
"realtytrac.com",
"rebootcash.com",
"recipezaar.com",
"recruitmax.com",
"reelgalleries.com",
"reference.com",
"remax.com",
"rent.com",
"resultsmaster.com",
"resultspage.com",
"reunion.com",
"reuters.com",
"revolutionhealth.com",
"rewardtv.com",
"rhapsody.com",
"righthealth.com",
"ringringmobile.com",
"ringtonemecca.com",
"ringtones.net",
"rmxads.com",
"rockyou.com",
"rootsweb.com",
"rottentomatoes.com",
"rr.com",
"runescape.com",
"rxlist.com",
"samsclub.com",
"sbc.com",
"scanmedios.com",
"scbih.com",
"scene7.com",
"scholastic.com",
"sciencecodex.com",
"scottrade.com",
"screensaver.com",
"screensavers.com",
"scribd.com",
"search.com",
"searchfeed.com",
"searchnut.com",
"sears.com",
"seekmo.com",
"seemygf.com",
"servicemagic.com",
"sexforsure.com",
"sexsearchcom.com",
"sexsearchtgp.com",
"sexzie.com",
"sfgate.com",
"shadylizard.com",
"sharebuilder.com",
"shoebuy.com",
"shop.com",
"shopica.com",
"shoplocal.com",
"shopping.com",
"shopzilla.com",
"shutterfly.com",
"sicgalleries.com",
"sidestep.com",
"signonsandiego.com",
"signupsystem.com",
"simplybestmovies.com",
"simplyhired.com",
"sing365.com",
"singlesnet.com",
"siteadvisor.com",
"skinvideo.com",
"slate.com",
"slickcash.com",
"slide.com",
"smarter.com",
"smileycentral.com",
"smugmug.com",
"smut.com",
"snagajob.com",
"snap.com",
"snapfish.com",
"snopes.com",
"socialsecurity.gov",
"softpedia.com",
"softwareonline.com",
"sony.com",
"sourceforge.net",
"southwest.com",
"spamblockerutility.com",
"sparknotes.com",
"speedpay.com",
"sportsauthority.com",
"sportsline.com",
"sprint.com",
"sprintpcs.com",
"spyshredderscanner.com",
"squidoo.com",
"ssa.gov",
"stanford.edu",
"staples.com",
"starpulse.com",
"state.gov",
"statementlook.com",
"streamate.com",
"stubhub.com",
"sublimedirectory.com",
"suite101.com",
"suitesmart.com",
"sunnygalleries.com",
"suntimes.com",
"superpages.com",
"surveymonkey.com",
"surveyrouter.com",
"swankdollars.com",
"switchboard.com",
"sxx.com",
"symantec.com",
"symantecstore.com",
"t-mobile.com",
"tagged.com",
"taleo.net",
"target.com",
"tastyporn.com",
"tbhostedgalleries.com",
"teen-hot.com",
"teendreams.com",
"teenminx.com",
"teenporngallery.net",
"teenstitsandass.com",
"tenmilliongalleries.com",
"teracent.net",
"test-speed.com",
"thebrazzers.com",
"thefreedictionary.com",
"thefreepornking.com",
"thehartford.com",
"thestreet.com",
"thewheelof.com",
"thinkquest.org",
"thirdmovies.com",
"thumblogger.com",
"thumbplay.com",
"ticketliquidator.com",
"ticketmaster.com",
"ticketsnow.com",
"tickle.com",
"tigerdirect.com",
"time.com",
"timeanddate.com",
"timeinc.net",
"timewarnercable.com",
"tinypic.com",
"topconsumergifts.com",
"topix.com",
"toseeka.com",
"toteme.com",
"toyota.com",
"toysrus.com",
"tracfone.com",
"trafficz.com",
"travelocity.com",
"travelzoo.com",
"trendmicro.com",
"tripadvisor.com",
"tripod.com",
"truly-movies.com",
"trustlogo.com",
"trymicrosoftoffice.com",
"tv.com",
"tvguide.com",
"twat4u.com",
"twistys.net",
"tx.us",
"typepad.com",
"ufl.edu",
"ugo.com",
"uiuc.edu",
"umich.edu",
"unicru.com",
"united.com",
"univision.com",
"ups.com",
"upspiral.us",
"urbandictionary.com",
"us.com",
"usa-people-search.com",
"usaa.com",
"usairways.com",
"usatoday.com",
"usbank.com",
"uscis.gov",
"usda.gov",
"userplane.com",
"usps.com",
"ussearch.com",
"usseek.com",
"utexas.edu",
"va.us",
"vacationstogo.com",
"vendio.com",
"veoh.com",
"verifiedbyvisa.com",
"verisign.com",
"verizon.com",
"verizon.net",
"verizonwireless.com",
"vh1.com",
"viagra.com",
"victoriassecret.com",
"videosz.com",
"vidmax.com",
"vidshadow.com",
"vidz.com",
"virginia.edu",
"vistaprint.com",
"voicefive.com",
"vonage.com",
"vzw.com",
"wa.gov",
"wachovia.com",
"walgreens.com",
"walmart.com",
"walmartstores.com",
"wamu.com",
"wamucards.com",
"wannawatch.com",
"warnerbros.com",
"washingtonpost.com",
"weather.com",
"webcrawler.com",
"webkinz.com",
"webmd.com",
"webroot.com",
"webshots.com",
"wellsfargo.com",
"whateverlife.com",
"where2getit.com",
"whitepages.com",
"whohasacrushonyou.com",
"wikihow.com",
"wikimedia.org",
"wikipedia.org",
"wildpornreviews.com",
"wildrhino.com",
"windows.com",
"windowsmarketplace.com",
"windowsmedia.com",
"winyourcruise.com",
"wisegeek.com",
"wordpress.com",
"worldcat.org",
"wqad.com",
"wsj.com",
"wunderground.com",
"wwe.com",
"www1.hp.com",
"www2.hp.com",
"www3.hp.com",
"xanga.com",
"xbox.com",
"xmovies.com",
"xnxx.com",
"xvidscollection.com",
"xxxkey.com",
"xxxpushers.com",
"yahoo.com",
"yahoo.net",
"yellowbook.com",
"yellowpages.com",
"yelp.com",
"yobt.com",
"youngleafs.com",
"youngporn.net",
"yourcrush.net",
"yourdictionary.com",
"yourgiftpro.com",
"yourtopbrands.com",
"youtube.com",
"zangocash.com",
"zappos.com",
"zillow.com",
"ztod.com")) &&
		  wp_has_no_rel_nofollow( $matches[1] ) &&
		  wp_has_no_rel_nofollow( $matches[4] ) )
	{
		return '<a rel="nofollow" href="' . $matches[2] . '//' . $matches[3] . '" ' . $matches[1] . $matches[4] . '>' . $matches[5] . '</a>';
	}
	else
	{
		// Do nothing
		return '<a href="' . $matches[2] . '//' . $matches[3] . '" ' . $matches[1] . $matches[4] . '>' . $matches[5] . '</a>';
	}
}
	

function wp_nofollow_Benifit($text) 
{
	$pattern = '/<a (.*?)href=[\"\'](.*?)\/\/(.*?)[\"\'](.*?)>(.*?)<\/a>/i';
	$text = preg_replace_callback($pattern,'parse_nofollow_Benifit',$text);
	return $text;
}

// filters have high priority to make sure that any markup plugins like Textile or Markdown have already created the HTML links
add_filter('the_content', 'wp_nofollow_Benifit', 10);
add_filter('the_excerpt', 'wp_nofollow_Benifit', 10);

// delete this one if you don't want it run on comments
add_filter('comment_text', 'wp_nofollow_Benifit', 10);
//add_filter('get_comment_author_link', 'wp_nofollow_Benifit', 999);

function wp_nofollow_Benifit_awareness() {
	global $wp_nr_footer_link;
	if($wp_nr_footer_link)echo ('');
}
if(function_exists('get_footer'))add_filter('get_footer', 'wp_nofollow_Benifit_awareness',10);
else add_action('wp_footer', 'wp_nofollow_Benifit_awareness',10);

?>
