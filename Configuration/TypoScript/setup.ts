#################################
# plugin.tx_agilecarousel
#################################

plugin.tx_agilecarousel {
	view {
		templateRootPath = {$plugin.tx_agilecarousel.view.templateRootPath}
		partialRootPath = {$plugin.tx_agilecarousel.view.partialRootPath}
		layoutRootPath = {$plugin.tx_agilecarousel.view.layoutRootPath}
	}
	persistence {
		storagePid = {$plugin.tx_agilecarousel.persistence.storagePid}
	}

	settings {

		asset {

			SwiperCss {
				path = EXT:agile_carousel/Resources/Public/StyleSheets/swiper.min.css
				type = css

				# Optional key if loading assets through EXT:vhs.
				dependencies = mainCss
			}

			NaturalCarouselCSS {
				path = EXT:agile_carousel/Resources/Public/StyleSheets/natural-carousel.min.css
				type = css

				# Optional key if loading assets through EXT:vhs.
				dependencies = mainCss
			}

			NaturalCarouselThemeCSS {
				path = EXT:agile_carousel/Resources/Public/StyleSheets/natural.min.css
				type = css

				# Optional key if loading assets through EXT:vhs.
				dependencies = mainCss
			}

			masterCss {
				path = EXT:agile_carousel/Resources/Public/StyleSheets/master.css
				type = css

				# Optional key if loading assets through EXT:vhs.
				dependencies = mainCss
			}

			SwiperJs {
				path = EXT:agile_carousel/Resources/Public/JavaScript/swiper.jquery.min.js
				type = js

				# Optional key if loading assets through EXT:vhs.
				dependencies = mainJs
			}

			NaturalCarouselJS {
				path = EXT:agile_carousel/Resources/Public/JavaScript/natural-carousel.min.js
				# path = EXT:agile_carousel/Resources/Public/Dev/natural-carousel-js/src/js/natural-carousel.js
				type = js

				# Optional key if loading assets through EXT:vhs.
				dependencies = mainJs
			}
			masterJs {
				path = EXT:agile_carousel/Resources/Public/JavaScript/master.js
				type = js

				# Optional key if loading assets through EXT:vhs.
				dependencies = mainJs
			}
		}

		loadAssetWithVhsIfAvailable = 1
	}
}
