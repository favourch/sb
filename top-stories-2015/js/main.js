String.prototype.trimToLength = function(m) {
  return (this.length > m) 
    ? jQuery.trim(this).substring(0, m).split(" ").slice(0, -1).join(" ") + "..."
    : this;
};

$.urlParam = function(name){
    var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
};


var siteURL = '/sb/top-stories-2015/';
var totalNumStories = 15;



function calcHeight(item,header) {
	var newHeight = (item.height() * 2) - 0.5; //shave off a teeny bit for pixel glitch
	header.height(newHeight);
	header.css('max-height',newHeight);
}

function getItem(windowWidth) {
	var item;
	if(windowWidth>800) {
		item = $('.calc-height');
	} else {
		item = $('.calc-height > img');
	}
	return item;
}

function getOpenOverlay() {
	return $('.overlay-wrapper').not(':hidden');
}

function getCurrrentStoryId() {
	var $overlay = getOpenOverlay();
	return $overlay.attr('data-story-id');
}

function getStoryOverlayBySlug(slug) {
	return $('.overlay-wrapper[data-story-slug="'+slug+'"]');
}

function getOverlayWrapperByID(storyID) {
	return $('.overlay-wrapper[data-story-id="'+storyID+'"]');
}

function getStoryIdBySlug(slug) {
	return getStoryOverlayBySlug(slug).attr('data-story-id');
}

function getStorySlugByID(storyID) {
	return getOverlayWrapperByID(storyID).attr('data-story-slug');
}

function getStoryURLByID(storyID) {
	return getOverlayWrapperByID(storyID).attr('data-story-url');
}

function getStoryTriggerByID(storyID) {
	return $('.trigger-overlay[data-story-id="'+storyID+'"]');
}

function getTitleByStoryID(storyID) {
	return $('.overlay-wrapper[data-story-id="'+storyID+'"]').attr('data-story-title');
}

function getStorySlug() {
	return $('body').attr('data-story-slug');
}

function getCurrentStorySlug() {
	var currentURL = $(location).attr('href');
	var n = currentURL.lastIndexOf('/');
	var storySlug = currentURL.substring(n + 1);
	return storySlug;
}

function setStorySlug(slug) {
	return $('body').attr('data-story-slug',slug);
}

function setContentHeight(ww,$openOverlay) {
	var $imgBox = $openOverlay.find('.img-box'),
	    $contentBox = $openOverlay.find('.content-box'),
	    $buttonBox = $openOverlay.find('.story-footer');

	calcContentHeight(ww,$imgBox,$contentBox,$buttonBox);
}

function calcContentHeight(ww,$imgBox,$contentBox,$buttonBox) {

	var imgBoxHeightDefault = 120;

	//reset heights
	$imgBox.height(imgBoxHeightDefault);
	$contentBox.height('auto');
	$buttonBox.height('auto');

	//get natural heights
	var imgBoxHeight = $imgBox.outerHeight();
	var contentBoxHeight = $contentBox.outerHeight();
	var buttonBoxHeight = $buttonBox.outerHeight();

	//calculate height of 3 sections combined
	var totalHeight = imgBoxHeight + contentBoxHeight + buttonBoxHeight;
	var windowHeight = $(window).height();

	//console.log('totalHeight: '+totalHeight);
	//console.log('windowHeight: '+windowHeight);
	//console.log('imgBoxHeight: '+imgBoxHeight);
	//console.log('contentBoxHeight: '+contentBoxHeight);
	//console.log('buttonBoxHeight: '+buttonBoxHeight);

	var newContentBoxHeight, difference;

	if(totalHeight<windowHeight && ww<1200) {
		//do resize
		difference = windowHeight - totalHeight;
		newContentBoxHeight = contentBoxHeight + difference;
		$imgBox.height(imgBoxHeightDefault);
		$contentBox.height(newContentBoxHeight);
	} else if (ww>=1200) {
		
		totalHeight = contentBoxHeight + buttonBoxHeight;
		
		if(totalHeight<windowHeight) {
			newContentBoxHeight = windowHeight - buttonBoxHeight;
			$contentBox.height(newContentBoxHeight);
			$imgBox.height(newContentBoxHeight);
		} else {
			$contentBox.height('auto');
			$imgBox.height($contentBox.outerHeight());
		}
		
	}
}

function getStoryData($overlayContent) {

	var storyData = {
		storyTitle : 	$overlayContent.attr('data-story-title'),
		storyURL : 		$overlayContent.attr('data-story-url'),
		storyImageURL : $overlayContent.attr('data-story-img-url'),
		storySlug : 	$overlayContent.attr('data-story-slug'),
		storyDesc : 	$overlayContent.find('.story').text().trimToLength(150)
	};

	return storyData;
}

function setMetaTags(storyData,isDefault) {
	var newTitle, newDesc, newURL, newImageURL;
	if(isDefault) {
		newTitle = 'Top 15 Stories of 2015 | Stony Brook University';
		newDesc = 'The top 15 stories and news headlines of 2015 from Stony Brook University have made an impact on Long Island, New York and the world.';
		newURL = 'http://stonybrook.edu/top15/';
		newImageURL = 'http://mobile.cc.stonybrook.edu/sb/top-stories-2015/img/header/stony-brook-top-15-stories-of-2015-masthead-1600.jpg';
	} else {
		newTitle = storyData.storyTitle + ' | Stony Brook University';
		newDesc = storyData.storyDesc;
		newURL = storyData.storyURL;
		newImageURL = storyData.storyImageURL;
	}
	$("title").text(newTitle);
	$("meta[name='description']").attr("content", newDesc);

	$("meta[property='og\\:title']").attr("content", newTitle);
	$("meta[property='og\\:description']").attr("content", newDesc);
	$("meta[property='og\\:url']").attr("content", newURL);
	$("meta[property='og\\:image']").attr("content", newImageURL);
}

function setTwitterURL($overlayContent) {
	var tweetHref = 'http://twitter.com/share?text=Check this out! "'+getStoryData($overlayContent).storyTitle+'"&amp;url='+getStoryData($overlayContent).storyURL;
	$overlayContent.find('.twitter-share-trigger').attr('href',tweetHref);
}

function pushHistoryState(newTitle,linkHref) {
	if(Modernizr.history) {
		history.pushState(null, newTitle, linkHref);
	}
}

function popHistoryState() {
	var currentURL = $(location).attr('href');
	var currentStorySlug = getCurrentStorySlug();
	var storyID = getStoryIdBySlug(currentStorySlug);
	var storyTrigger = getStoryTriggerByID(storyID);
		//console.log(currentURL);
		//console.log(currentStorySlug);
		//console.log(getCurrentStorySlug());
		//console.log('langing');
	if(currentURL.match(/top-stories-2015\/$/) || currentURL.match(/top-stories-2015$/)) {
		//if the overlay is open, close it
		if($('.overlay').hasClass('open')) {
			//storyTrigger.trigger('click');
			//console.log($(this));
			var $overlayWrapper = getOverlayWrapperByID(getStoryIdBySlug(getStorySlug()));
			$overlayWrapper.attr('data-push-state','false');
			//console.log(getStoryIdBySlug(getStorySlug()));
			//console.log($overlayWrapper);
			//console.log($overlayWrapper.attr('data-push-state'));
			getOpenOverlay().find('.button.overlay-close').trigger('click');
			//updateOverlayContent(storyID);
		}
	} else {
		getStoryOverlayBySlug(currentStorySlug).attr('data-push-state','false');
		updateOverlayContent(storyID);
	}
}

function updateOverlayContent(storyID) {
	//reset the open overlay-wrapper to be hidden
	$('.overlay-wrapper').hide();

	$overlayContent = $('.overlay-wrapper[data-story-id="'+storyID+'"]');
	$overlayContent.show();
	$('body').addClass('disable-scroll');
	$('.overlay').addClass('open');

	var ww = $(window).width();

	setContentHeight(ww,getOpenOverlay());
	storyData = getStoryData($overlayContent);
	setMetaTags(storyData,false);
	setTwitterURL($overlayContent);

	//console.log(storyData.storySlug);

	var linkHref = siteURL + storyData.storySlug;
	if($overlayContent.attr('data-push-state')!='false') {
		pushHistoryState(storyData.storyTitle,linkHref);
	} else {
		$overlayContent.attr('data-push-state','true');
	}

	$('body').attr('data-story-slug',storyData.storySlug);

	var gaSlug = '/'+storyData.storySlug;
	//send GA pageview
	ga('set', {
		page: gaSlug,
		title: storyData.storyTitle
	});
	ga('send', 'pageview');

	//build next/prev text
	var prevID = parseInt(storyID) - 1;
	var nextID = parseInt(storyID) + 1;

	if(prevID < 1) {
		prevID = totalNumStories;
	}
	if(nextID > totalNumStories) {
		nextID = 1;
	}

	$('.previous-story-trigger').attr('data-story-id',prevID);
	$('.next-story-trigger').attr('data-story-id',nextID);

	var prevTitle = getTitleByStoryID(prevID);
	var nextTitle = getTitleByStoryID(nextID);

	$('.previous-story-trigger').attr('data-story-title',prevTitle);
	$('.next-story-trigger').attr('data-story-title',nextTitle);

	$('.prev-story-preview h4').text(prevTitle);
	$('.next-story-preview h4').text(nextTitle);
}

if(Modernizr.history) {
	window.addEventListener("popstate", function(e) {
		$(document).ready(function(){
			popHistoryState();
		});
	});
}

$(document).ready(function(){

	// attach fastclick
	FastClick.attach(document.body);
	
	var $triggerBttn = $('#trigger-overlay-btn'),
		$triggerBox = $('.trigger-overlay'),
		$overlay = $('.overlay'),
		$closeBttn = $('button.overlay-close');
		transEndEventNames = {
			'WebkitTransition': 'webkitTransitionEnd',
			'MozTransition': 'transitionend',
			'OTransition': 'oTransitionEnd',
			'msTransition': 'MSTransitionEnd',
			'transition': 'transitionend'
		},
		transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
		support = { transitions : Modernizr.csstransitions };

	function toggleOverlay(storyID, nextStoryID, pushState) {

		if(typeof getStorySlugByID(storyID) == 'undefined') {

			//console.log('story summary not found');

		} else {

			var storyData;
			var $overlayWrapper = getOverlayWrapperByID(storyID);

			if($overlay.hasClass('open')) {
				$overlay.removeClass('open');
				$overlay.addClass('close');

				var onEndTransitionFn = function( ev ) {
					if(support.transitions) {
						//if( ev.propertyName !== 'visibility' ) return;
						$(this).unbind( transEndEventName, onEndTransitionFn );
					}

					$('body').removeClass('disable-scroll');
					$overlay.removeClass('close');
				};

				if(support.transitions) {
					$overlay.on(transEndEventName, onEndTransitionFn);
				} else {
					onEndTransitionFn();
				}

				//console.log(storyID);
				//console.log($overlayWrapper);
				//console.log($overlayWrapper.attr('data-push-state'));

				if($overlayWrapper.attr('data-push-state')=='false') {
					pushState = false;
				}
				//console.log(pushState);
				//console.log();

				//console.log(getCurrentStorySlug());
				if(pushState===true) {
					history.pushState(null, null, siteURL);
				} else {
					$overlayWrapper.attr('data-push-state','');
				}
				setMetaTags(storyData,true);

				if(nextStoryID>0) {
					toggleOverlay(nextStoryID);
				}
			}
			else if( !$overlay.hasClass('close') ) {
				updateOverlayContent(storyID);
			}

		}
	}

	$triggerBttn.on('click',function() {
		var storyID = '1';
		toggleOverlay(storyID, false);
	});

	$triggerBox.on('click',function() {
		var storyID = $(this).attr('data-story-id');
		toggleOverlay(storyID, false);
	});


	$closeBttn.on('click',function() {
		var storyID = $(this).closest('.overlay-wrapper').attr('data-story-id');
		//console.log($(this).closest('.overlay-wrapper'));
		//console.log(storyID);
		toggleOverlay(storyID, false, true);
	});

	/* calc header height */

	var header = $('.header-image-wraper');
	var ww;

	$(window).load(function(){
		ww = $(window).width();
		calcHeight(getItem(ww),header);
	});
	$(window).resize(function(){
		ww = $(window).width();
		calcHeight(getItem(ww),header);
		var $openOverlay = getOpenOverlay();
		setContentHeight(ww,$openOverlay);
	});

	/* default story URL */

	var defaultStorySlug = getCurrentStorySlug();
	var defaultStoryID, defaultStoryTrigger;
	setStorySlug(defaultStorySlug);
	//console.log(defaultStorySlug);
	if( defaultStorySlug && (!defaultStorySlug.startsWith('index.')) && (!defaultStorySlug.startsWith('content?')) && defaultStorySlug!=null && defaultStorySlug!='undefined' ) {
		defaultStoryID = getStoryIdBySlug(decodeURIComponent(defaultStorySlug));
		//console.log(defaultStoryID);
		toggleOverlay(defaultStoryID, false);

		ww = $(window).width();
		calcHeight(getItem(ww),header);
		var $openOverlay = getOpenOverlay();
		setContentHeight(ww,$openOverlay);
	}

	/* social share */

	$('.facebook-share-trigger').on('click',function() {
		var storyURL = getStoryData(getOpenOverlay()).storyURL;
		//console.log(storyURL);

		FB.ui({
			method: 'share',
			href: storyURL,
		}, function(response){
			var $fbTrigger = getOpenOverlay().find('.facebook-share-trigger');
			$fbTrigger.addClass('submitted').attr('disabled','disabled');
		});
	});

	$('.twitter-share-trigger').on('click',function(e) {
		window.open(this.href, "Share on Twitter", "width=600, height=600");
		var $tweetTrigger = getOpenOverlay().find('.twitter-share-trigger');
		$tweetTrigger.addClass('submitted');
    	return false;
	});

	$('.story-read-trigger').on('click',function(e) {
		if($(window).width()>1800) {
			window.open(this.href, "Read on SBU", "width=1260, height=1000");
    		return false;
		} else if($(window).width()>1200) {
			window.open(this.href, "Read on SBU", "width=1024, height=850");
    		return false;
		} else if($(window).width()>960) {
			window.open(this.href, "Read on SBU", "width=960, height=750");
    		return false;
		} else {
			return;
		}
	});

	$('.story-nav-button').hover(
		function() {
			if($('.overlay').attr('disable-preview-hover')!='true') {
				var type = $(this).attr('data-page-type');
				var previewSelector = '.' + type + '-story-preview';
				getOpenOverlay().addClass('blur');
				$(previewSelector).addClass('show');
			}
		}, function() {
			var type = $(this).attr('data-page-type');
			var previewSelector = '.' + type + '-story-preview';
			getOpenOverlay().removeClass('blur');
			$(previewSelector).removeClass('show');
		}
	);

	$('.content-box, .img-box').hover(
		function() {
			if($('.overlay').attr('disable-preview-hover')=='true') {
				$('.overlay').attr('disable-preview-hover','false');
			}
		}
	);

	$('.story-nav-button').on('click',function() {
		var storyID = $(this).attr('data-story-id');
		updateOverlayContent(storyID);
		$('.story-preview').removeClass('show');
		$('.overlay-wrapper').removeClass('blur');
		$('.overlay').attr('disable-preview-hover','true');
	});


});