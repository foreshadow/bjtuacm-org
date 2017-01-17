@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">写文章</div>
        <div class="panel-body">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>发布失败</strong> 输入不符合要求<br><br>
              {!! implode('<br>', $errors->all()) !!}
            </div>
          @endif
          {{ Form::open(['url' => 'article', 'method' => 'post']) }}
            <input type="text" name="title" class="form-control" required="required" placeholder="标题">
            <br>
            <textarea name="body" rows="10" class="form-control" required="required" placeholder="内容"></textarea>
            <br>
            <div class="col-md-4">
              @icon('file')
              {{ Form::label('', '内容格式') }}
              {{ Form::select('renderer', array('markdown' => 'markdown', 'html' => 'html', 'plaintext' => 'plain text'), 'markdown', ['class' => 'form-control']) }}
              <span class="help-block"><small>尝试一下markdown吧！</small></span>
            </div>
            <div class="form-group col-md-8">
              {{ Form::checkbox('toc', '1', true) }}
              @icon('list')
              {{ Form::label('', '目录') }}
              <span class="help-block" style="display: initial;"><small>包含标题元素的导航窗格。</small></span>
              <br>
              {{ Form::checkbox('label', '1', false) }}
              <small>1.1&emsp;</small>
              {{ Form::label('', '数字节标题') }}
              <span class="help-block" style="display: initial;"><small>markdown格式中，所有标题会按顺序加上形如1.1的数字。</small></span>
              <br>
              {{ Form::checkbox('public', '1', false) }}
              @icon('eye-open')
              {{ Form::label('', '公开') }}
              <span class="help-block" style="display: initial;"><small>公开后你的文章将对所有人可见，并且有可能出现在首页最近列表中。</small></span>
              <button class="btn btn-sm btn-primary pull-right">@icon('send')发布</button>
            </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
