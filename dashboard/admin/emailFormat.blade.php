<?php
// echo '<pre>';
// print_r($languagePairRowExist);
// print_r($translatorDetails);
// die;
?>



@extends('layouts.user')

@section('content')

@php
 $translatorUcode = Request::segment(4) ?? NULL;
@endphp


<div class="row margin">
  <div class="input-field col s12">
    <table class="subscription-table responsive-table highlight">
    <thead>
     <tr>
      <th>Language Direction</th>
      <th>Current Score</th>
      <th>Current Rating</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($languagePairRowExist as $languagePairEach)
    <tr id="myTableRow_{{ $languagePairEach->id }}">
    <td>{{ $languagePairEach->name }}</td>
    <td>{{ $languagePairEach->final_score }} / 500</td>
    <td>{{ $languagePairEach->final_rating }} / 5</td>
    </tr>
    @endforeach
  </tbody>
</table>
  </div>
</div>