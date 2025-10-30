#################################
# plugin.tx_naturalcarousel
#################################

plugin.tx_naturalcarousel {
	view {
		templateRootPath = {$plugin.tx_naturalcarousel.view.templateRootPath}
		partialRootPath = {$plugin.tx_naturalcarousel.view.partialRootPath}
		layoutRootPath = {$plugin.tx_naturalcarousel.view.layoutRootPath}
	}
	persistence {
		storagePid = {$plugin.tx_naturalcarousel.persistence.storagePid}
	}

	settings {

		asset {

			SwiperCss {
				path = EXT:natural_carousel/Resources/Public/StyleSheets/swiper.min.css
				type = css

				# Optional key if loading assets through EXT:vhs.
				dependencies.1 = mainCss
			}

			NaturalCarouselCSS {
				path = EXT:natural_carousel/Resources/Public/StyleSheets/natural-carousel.min.css
				#path = EXT:natural_carousel/Resources/Public/Dev/natural-carousel-js/dist/natural-carousel.min.css
				type = css

				# Optional key if loading assets through EXT:vhs.
				dependencies.1 = mainCss
			}

			NaturalCarouselThemeCSS {
				path = EXT:natural_carousel/Resources/Public/StyleSheets/natural.css
				#path = EXT:natural_carousel/Resources/Public/Dev/natural-carousel-js/dist/themes/natural.css
				type = css

				# Optional key if loading assets through EXT:vhs.
				dependencies.1 = mainCss
			}

			masterCss {
				path = EXT:natural_carousel/Resources/Public/StyleSheets/master.css
				type = css

				# Optional key if loading assets through EXT:vhs.
				dependencies.1 = mainCss
			}

			SwiperJs {
				path = EXT:natural_carousel/Resources/Public/JavaScript/swiper.jquery.min.js
				type = js

				# Optional key if loading assets through EXT:vhs.
				dependencies.1 = mainJs
			}

			NaturalCarouselJS {
				path = EXT:natural_carousel/Resources/Public/JavaScript/natural-carousel.min.js
				#path = EXT:natural_carousel/Resources/Public/Dev/natural-carousel-js/src/js/natural-carousel.js
				type = js

				# Optional key if loading assets through EXT:vhs.
				dependencies.1 = mainJs
			}
			masterJs {
				path = EXT:natural_carousel/Resources/Public/JavaScript/master.js
				type = js

				# Optional key if loading assets through EXT:vhs.
				dependencies.1 = mainJs
			}
		}

		loadAssetWithVhsIfAvailable = 1
	}
}
