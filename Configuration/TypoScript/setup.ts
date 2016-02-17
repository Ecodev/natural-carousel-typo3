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
			AgileCarouselCss {
				path = EXT:agile_carousel/Resources/Public/StyleSheets/AgileCarousel.css
				type = css

				# Optional key if loading assets through EXT:vhs.
				dependencies = mainCss
			}

			SwiperJs {
				path = EXT:agile_carousel/Resources/Public/JavaScript/swiper.min.js
				type = js

				# Optional key if loading assets through EXT:vhs.
				dependencies = mainJs
			}
			AgileCarouselJs {
				path = EXT:agile_carousel/Resources/Public/JavaScript/AgileCarousel.js
				type = js

				# Optional key if loading assets through EXT:vhs.
				dependencies = mainJs
			}
		}

		loadAssetWithVhsIfAvailable = 1
	}
}
