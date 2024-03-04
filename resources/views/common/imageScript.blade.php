<script>
    $(() => $('.image-preview').css({
        'background-image': 'url({{  asset($image) }})',
        'background-size': 'cover',
        'background-position': 'center center',
    }));
</script>
