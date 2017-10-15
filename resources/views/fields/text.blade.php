@extends('fields.main')

@section('field')
	<input type="text" id="{{ $field }}" name="{{ $field }}" value="{{ old($field, isset($entity) && $entity !== null ? $entity->$field : '') }}" class="form-control">
@overwrite
