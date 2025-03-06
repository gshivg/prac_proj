// tailwind.config.js

module.exports = {
    presets: [
        require("./vendor/power-components/livewire-powergrid/tailwind.config.js"),
    ],
    theme: {
        extend: {
            colors: {
                "pg-primary": colors.red,
            },
        },
    },
    darkMode: 'class',
}
