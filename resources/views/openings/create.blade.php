@extends('layouts.app')

@section('content')

<?php 
    $skills = return_resume_Skills();
    $current_opening_skills = $opening ? $opening->skill_requirements()->lists('opening_skills.id')->toArray() : [];
?>

<style type="text/css">
    .ui.form{
        font-size: 12px;
    }

    .page-header .fa{
        color: #0f739b;
    }
</style>

<div class="container" style="padding-top:20px;">
    <h1>{{$opening ? 'Update Opening' : 'Write a New Opening'}}</h1>
    <hr>
    @include('errors.form_errors')
    {!!Form::open(['route' => 'openings.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <input type="hidden" name="opening_id" value="{{$_GET['opening_id'] ?? 0}}">
    <div class="row">
        <div class="col-md-6">
            <h4 class="page-header"><i class="fa fa-file-text" aria-hidden="true"></i> Basic Job Info</h4>
            <div class="ui form">
                <label>Job Title</label>
                <input type="text" value="{{ $opening->title ?? old('title') }}" name="title">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="ui form">
                        <label>Salary Range</label>
                        {!!Form::select('salary_range', salary_ranges(), $opening ? $opening->salary_range : null, ['class' => 'ui dropdown single-select fluid', 'id' => 'salary_range'])!!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ui form">
                        <label>Hiring Type</label>
                        <select class="ui dropdown single-select fluid" name="hiring_type">
                            <option value="0" {{$opening ? ($opening->hiring_type == 0 ? 'selected' : '') : ''}}>Intern</option>
                            <option value="1" {{$opening ? ($opening->hiring_type == 1 ? 'selected' : '') : ''}}>Regular</option>
                            <option value="2" {{$opening ? ($opening->hiring_type == 2 ? 'selected' : '') : ''}}>Part-time</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="ui form">
                <label>Details</label>
                <textarea type="text" name="details">{{ $opening->details ?? old('details') }}</textarea>
            </div>
            <div class="ui form">
                <label>Requirements</label>
                <textarea type="text" name="requirements">{{ $opening->requirements ?? old('requirements') }}</textarea>
            </div>

            <br />
            <div class="ui form">
                <label>Start date</label>
                <input type="date" value="{{ $opening->from_post ?? old('from_post') }}" name="from_post">
            </div>


        </div>
        <div class="col-md-6">
            <h4 class="page-header">
                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                Skill Requirements
                <span id="skill_required" style="color:#a94442;"></span>
            </h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>PHP</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "PHP")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}} >{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ruby</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "Ruby")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Java</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "Java")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>C++</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "C++")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Python</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "Python")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Swift</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "Swift")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Go</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "Go")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>C#</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "C#")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Javascript</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "Javascript")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Node.js</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "Node.js")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>version control</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "version control")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>CSS framework</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "CSSframework")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>CSS preprocessors/postprocessors</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "CSSpreprocessors/postprocessors")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Cloud hosting</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "Cloud hosting")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Mobile app programming</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "Mobileappprogramming")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Database</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "Database")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Other Languages</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "otherlanguages")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Other tools</label>
                        <select multiple="" name="skills[]" class="ui fluid normal dropdown multi-select">
                            <option value="">Select</option>
                            @for($i=0; $i < count($skills) ; $i++)
                                @if($skills[$i]->language == "othertools")
                                    <option value={{$skills[$i]->id}} {{in_array($skills[$i]->id,$current_opening_skills) ? 'selected' : ''}}>{{$skills[$i]->category}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('company_id', $company_id) !!}
    <hr>
    <button class="ui blue button massive pull-right">Save</button>
    {!!Form::close()!!}
</div>

@endsection
