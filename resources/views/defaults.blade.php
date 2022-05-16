@extends('statamic::layout')

@section('content')

    <publish-form
        title="{{ $title }}"
        action="{{ $action }}"
        :blueprint='@json($blueprint)'
        :meta='@json($meta)'
        :values='@json($values)'
    ></publish-form>

    @include('statamic::partials.docs-callout', [
        'topic' => __('tinymce-cloud::defaults.tinymce'),
        'url' => 'https://www.tiny.cloud'
    ])
@stop
