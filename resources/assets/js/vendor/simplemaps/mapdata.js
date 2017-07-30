var simplemaps_usmap_mapdata={
    main_settings: {
        //General settings
        width: "responsive", //or 'responsive'
        background_color: "#FFFFFF",
        background_transparent: "yes",
        border_color: "#ffffff",
        popups: "detect",

        //State defaults
        state_description: "Not Supported",
        state_color: "#CCCCCC",
        state_hover_color: "#AAAAAA",
        state_url: "",
        border_size: 1.5,
        all_states_inactive: "yes",
        all_states_zoomable: "no",

        //Location defaults
        location_description: "Add location markers using latitude and longitude!",
        location_color: "#2041D4",
        location_opacity: 0.8,
        location_hover_opacity: 1,
        location_url: "",
        location_size: 25,
        location_type: "square",
        location_image_source: "frog.png",
        location_border_color: "#FFFFFF",
        location_border: 2,
        location_hover_border: 2.5,
        all_locations_inactive: "no",
        all_locations_hidden: "no",

        //Label defaults
        label_color: "#6e6e6e",
        label_hover_color: "#d5ddec",
        label_size: 22,
        label_font: "Arial",
        hide_labels: "no",
        hide_eastern_labels: "no",

        //Zoom settings
        zoom: "yes",
        back_image: "no",
        initial_back: "no",
        initial_zoom: -1,
        initial_zoom_solo: "no",
        region_opacity: 1,
        region_hover_opacity: 0.6,
        zoom_out_incrementally: "yes",
        zoom_percentage: 0.99,
        zoom_time: 0.5,

        //Popup settings
        popup_color: "white",
        popup_opacity: 0.9,
        popup_shadow: 1,
        popup_corners: 5,
        popup_font: "12px/1.5 Verdana, Arial, Helvetica, sans-serif",
        popup_nocss: "no",

        //Advanced settings
        div: "supported-states-map",
        auto_load: "yes",
        url_new_tab: "no",
        images_directory: "/static/lib/simplemaps/map_images/",
        fade_time: 0.1,
        link_text: "View Website",
        location_image_url: ""
    },
    state_specific: {
        HI: {
            name: "Hawaii",
            description: "default",
            color: "default",
            hover_color: "default",
            url: "default",
            hide: "default",
            inactive: "default",
            zoomable: "default"
        },
        AK: {
            name: "Alaska"
        },
        FL: {
            name: "Florida"
        },
        NH: {
            name: "New Hampshire"
        },
        VT: {
            name: "Vermont"
        },
        ME: {
            name: "Maine"
        },
        RI: {
            name: "Rhode Island"
        },
        NY: {
            name: "New York"
        },
        PA: {
            name: "Pennsylvania"
        },
        NJ: {
            name: "New Jersey"
        },
        DE: {
            name: "Delaware"
        },
        MD: {
            name: "Maryland"
        },
        VA: {
            name: "Virginia"
        },
        WV: {
            name: "West Virginia"
        },
        OH: {
            name: "Ohio"
        },
        IN: {
            name: "Indiana"
        },
        IL: {
            name: "Illinois"
        },
        CT: {
            name: "Connecticut"
        },
        WI: {
            name: "Wisconsin"
        },
        NC: {
            name: "North Carolina"
        },
        DC: {
            name: "District of Columbia"
        },
        MA: {
            name: "Massachusetts"
        },
        TN: {
            name: "Tennessee"
        },
        AR: {
            name: "Arkansas"
        },
        MO: {
            name: "Missouri"
        },
        GA: {
            name: "Georgia"
        },
        SC: {
            name: "South Carolina"
        },
        KY: {
            name: "Kentucky"
        },
        AL: {
            name: "Alabama"
        },
        LA: {
            name: "Louisiana"
        },
        MS: {
            name: "Mississippi"
        },
        IA: {
            name: "Iowa"
        },
        MN: {
            name: "Minnesota"
        },
        OK: {
            name: "Oklahoma"
        },
        TX: {
            name: "Texas"
        },
        NM: {
            name: "New Mexico"
        },
        KS: {
            name: "Kansas"
        },
        NE: {
            name: "Nebraska"
        },
        SD: {
            name: "South Dakota"
        },
        ND: {
            name: "North Dakota"
        },
        WY: {
            name: "Wyoming"
        },
        MT: {
            name: "Montana"
        },
        CO: {
            name: "Colorado"
        },
        UT: {
            name: "Utah",
            color: "#88A4BC",
            hover_color: "#3B729F",
            inactive: "no",
            description: "Supported!  Click for more info.",
            url: "/UT"
        },
        AZ: {
            name: "Arizona"
        },
        NV: {
            name: "Nevada"
        },
        OR: {
            name: "Oregon"
        },
        WA: {
            name: "Washington"
        },
        CA: {
            name: "California"
        },
        MI: {
            name: "Michigan"
        },
        ID: {
            name: "Idaho"
        },
        GU: {
            name: "Guam",
            hide: "yes"
        },
        VI: {
            name: "Virgin Islands",
            hide: "yes"
        },
        PR: {
            name: "Puerto Rico",
            hide: "yes"
        },
        MP: {
            name: "Northern Mariana Islands",
            hide: "yes"
        },
        AS: {
            name: "American Samoa",
            hide: "yes"
        }
    },
    locations: {},
    labels: {
        HI: {
            color: "default",
            hover_color: "default",
            font_family: "default",
            pill: "yes",
            width: "default"
        }
    },
    regions: {}
};