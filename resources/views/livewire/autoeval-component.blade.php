<div>
    {{ $survey }}



    @script
        <script>
            document.addEventListener('livewire:init', () => {
                console.log("init");
            })
            document.addEventListener('livewire:initialized', () => {
                // Runs immediately after Livewire has finished initializing
                // on the page...
                console.log("livewire:initialized'");
                console.log($survey);
            })
        </script>
    @endscript
</div>
