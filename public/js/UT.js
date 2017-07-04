/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 40);
/******/ })
/************************************************************************/
/******/ ({

/***/ 31:
/***/ (function(module, exports) {


function init() {
    setDistrictState('reset');

    var application = window.Laravel.application;
    if (application.data.location_id != undefined) {

        // get the location
        var locations = application.state.locations;
        var locationId = application.data.location_id;
        var location = _.find(locations, function (item) {
            return item.id == locationId;
        });

        // select the county
        var countyId = location.county_id;
        $('#county-id option:selected').removeProp('selected');
        $('#county-id option[value="' + countyId + '"]').prop('selected', 'selected');
        $('#county-id').trigger('change', { county_id: countyId, district_id: location.district_id, location_id: location.id });
    }
}

function setDistrictState(state) {
    switch (state) {
        case 'reset':
            setLocationState('reset');
            $districtIdSelect.html('<option>Select a County First</option>').prop('disabled', true);
            break;
        case 'loading':
            setLocationState('reset');
            $districtIdSelect.html('<option>Loading...</option>').prop('disabled', true);
            break;
        case 'active':
            $districtIdSelect.prop('disabled', false);
            break;
    }
}

function setLocationState(state) {
    switch (state) {
        case 'reset':
            $locations.html('Select a district first...');
            break;
        case 'loading':
            $locations.html('<i class="fa fa-spinner fa-spin"></i> Loading...');
            break;
        case 'active':

            break;
    }
}

$(function () {

    $countyIdSelect = $('#county-id');
    $districtIdSelect = $('#district-id');
    $locations = $('.locations-container');

    // when a county is selected load districts
    $countyIdSelect.change(function (e, defaults) {
        setDistrictState('loading');

        var countyId = $('#county-id option:selected').val();

        axios.get('/counties/' + countyId).then(function (response) {
            var districts = response.data.districts;
            var options = '<option value="">Select a District</option>';
            for (var i = 0; i < districts.length; i++) {
                options += '<option value="' + districts[i].id + '">' + districts[i].name + '</option>';
            }
            $districtIdSelect.html(options);
            setDistrictState('active');

            if (defaults != undefined) {
                if (defaults.district_id) {
                    $('#district-id option:selected').removeProp('selected');
                    $('#district-id option[value="' + defaults.district_id + '"]').prop('selected', 'selected');
                }

                if (defaults.location_id) {
                    $('#district-id').trigger('change', defaults);
                }
            }
        }).catch(function (error) {
            setDistrictState('reset');
        });
    });

    $districtIdSelect.change(function (e, defaults) {
        setLocationState('loading');

        var countyId = $('#county-id option:selected').val();
        var districtId = $('#district-id option:selected').val();

        if (defaults == undefined) {
            defaults = { location_id: null };
        }

        axios.get('/locations', {
            params: {
                county_id: countyId,
                district_id: districtId
            }
        }).then(function (response) {
            var locations = response.data;

            var html = '<div class="help-block">Remember to double check these with another source!</div>';
            for (var i in locations) {
                var location = locations[i];
                html += '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 location-block">' + '<label class="radio">' + '<input type="radio" class="court-location" name="data[location_id]" value="' + location.id + '" ' + (defaults.location_id == location.id ? 'checked="checked"' : '') + '/>' + '<address>' + '<pre>' + location.address + '<br/><a href="https://www.google.com/maps/place/' + encodeURIComponent(location.address) + '" target="_blank"><i class="fa fa-map-marker"></i> View On Map</a></pre>' + '</address>' + '</label>' + '</div>';
            }

            $locations.html(html);
            setLocationState('active');
        }).catch(function (error) {
            setLocationState('reset');
        });
    });

    init();
});

/***/ }),

/***/ 32:
/***/ (function(module, exports) {

$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();

    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);

        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var curStep = $(this).closest('.tab-pane'),
            curInputs = curStep.find('input, select'),
            isValid = true;

        if (window.validator !== undefined) {
            for (var i = 0; i < curInputs.length; i++) {
                if (!window.validator.element(curInputs[i])) {
                    isValid = false;
                }
            }
        }

        if (isValid) {
            var $active = $('.board .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);
        }
    });

    $(".prev-step").click(function (e) {

        var $active = $('.board .nav-tabs li.active');
        prevTab($active);

        var $btn = $(this);
        var callback = $btn.data('callback');
        if (callback != undefined) {
            $btn.button('loading');
            var result = { callback: callback }($btn);
            $btn.button('reset');

            if (result === false) {
                return false;
            }
        }
    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}

function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}

/***/ }),

/***/ 40:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(9);


/***/ }),

/***/ 9:
/***/ (function(module, exports, __webpack_require__) {

/**
 * Created by Lea on 7/4/2017.
 */

__webpack_require__(32);
__webpack_require__(31);

$(document).ready(function () {
    window.validator = $("#application-form").validate({
        debug: true,
        rules: {
            'data[county_id]': {
                required: true
            },
            'data[district_id]': {
                required: true
            },
            'data[location_id]': {
                required: true
            }

        }

    });

    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        saveApplication(e);
    });
});

function saveApplication($e) {
    var $form = $('#application-form');

    var data = $('#application-form').serialize();
    axios.post($form.attr('action'), data).then(function (response) {
        console.log('saved');
        //console.log(response);
    }).catch(function (error) {
        //console.log(error);
        console.log('error saving');
    });
}

/***/ })

/******/ });