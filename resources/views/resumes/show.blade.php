@extends('layouts.app')

@section('content')

<div class="container">

    @include('inc.message')

    <div id="cv" class="instaFade">
        <div class="mainDetails col-md-5">
            <div id="photo_name" class="row">
                <div class="row">
                    <div class="col-md-12">
                        <div id="headshot" class="quickFade">
                            <img style="width:100%; max-width: 150px; -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3); border-radius: 4px;" class="_image" src="{{ $resume->photo }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="name">
                        <h2 class="" style="color:#838383;">{{$resume->f_name}} {{$resume->m_name}} {{$resume->l_name}}</h2>
                        <h3 class="" style="color:#838383;">{{$resume->job_title}}</h3>
                    </div>
                </div>
            </div>
            <div id="other_profile" class="row">
                <div id="contactDetails" class="">
                    <div class="sectionTitle">
                        <h1>Personal Profile&nbsp;</h1>
                    </div>
                    <ul>
                        <li class="clear">
                            <a href="mailto:{{$resume->email}}" target="_blank">
                                {{$resume->email}}
                            </a>
                            &nbsp;&nbsp;
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;&nbsp;
                        </li>
                        <li class="clear">
                            {{$resume->phone_number}}
                            &nbsp;&nbsp;
                            <i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;
                        </li>
                        <li class="clear">
                            {{$resume->address1}}
                            {{$resume->address2}}&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;
                        </li>
                        <li class="clear">
                            {{$resume->city}}
                            {{$resume->country}}
                            {{$resume->postal}}
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </li>
                    </ul>
                </div>
                <div id="contactDetails" class="clear">
                    <div class="sectionTitle">
                        <h1>Languages&nbsp;</h1>
                    </div>
                    <ul>
                        <li class="clear">
                            {{$resume->spoken_language}}
                            &nbsp;&nbsp;
                            <i class="fa fa-language" aria-hidden="true"></i>&nbsp;&nbsp;
                        </li>
                    </ul>
                </div>
            </div>
            {{-- <div class="clear"></div> --}}
        </div>
        
        <div id="mainArea" class="col-md-7">
            <div id="mainArea-inner">
                <section>
                    <article>
                        <div class="sectionTitle">
                            <h1>Personal Profile</h1>
                        </div>
                        
                        <div class="sectionContent">
                            <p>{{$resume->summary}}</p>
                        </div>
                    </article>
                    <div class="clear"></div>
                </section>
                
                <section>
                    <article>
                        <div class="sectionTitle">
                            <h1>Educational Background</h1>
                        </div>
                        
                        <div class="sectionContent">
                            @foreach($resume->educations as $education)
                            <div class="education">
                                <h2>{{$education->ed_university}}</h2>
                                @if($education->ed_program_of_study != '' && $education->ed_field_of_study != '')
                                    <h4>{{$education->ed_program_of_study}}&nbsp;&nbsp;{{$education->ed_field_of_study}}</h4>
                                @elseif($education->ed_program_of_study == '' && $education->ed_field_of_study != '')
                                    <h4>{{$education->ed_field_of_study}}</h4>
                                @else
                                    <h4>{{$education->ed_program_of_study}}</h4>
                                @endif
                                <p class="subDetails">{{return_month($education->ed_from_month)}}, {{$education->ed_from_year}}&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;{{return_month($education->ed_to_month)}}, {{$education->ed_to_year}}</p>
                            </div>
                            @endforeach
                        </div>
                        <div class="clear"></div>
                    </article>
                </section>
                
                <section>
                    <article>
                        <div class="sectionTitle">
                            <h1>Work Experience</h1>
                        </div>
                        <div class="sectionContent">
                            @foreach($resume->experiences as $experience)
                                <h2>{{$experience->ex_company}}</h2>
                                <h4>{{$experience->ex_postion}}</h4>
                                <p class="subDetails">{{ return_month($experience->ex_from_month) }}, {{$experience->ex_from_year}}&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;{{return_month($experience->ex_to_month)}}, {{$experience->ex_to_year}}</p>
                                <p>{{$experience->ex_explanation}}</p>
                            @endforeach
                        </div>
                        <div class="clear"></div>
                    </article>
                </section>
                
                
                <section>
                    <article>
                        <div class="sectionTitle">
                            <h1>Key Skills</h1>
                        </div>
                        
                        <div class="sectionContent">
                            <ul class="keySkills">
                                {{-- {{$skill_ids}} --}}
                                @foreach($skill_ids as $skill_id)
                                    @if(in_array($skill_id,get_language_ids('PHP')))
                                        <?php $a = 1;?>
                                        @if($a == 1)
                                            <h4>PHP</h4>
                                        @endif
                                            <li>{{return_category($skill_id)}}</li>
                                            <?php $a += 1;?>
                                    @endif
                                    @if(in_array($skill_id,get_language_ids('Ruby')))
                                        <?php $a = 1;?>
                                        @if($a == 1)
                                            <h4>Ruby</h4>
                                        @endif
                                            <li>{{return_category($skill_id)}}</li>
                                            <?php $a += 1;?>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </article>
                </section>
                
                <section>
                    <article>
                        <div class="sectionTitle">
                            <h1>Objective</h1>
                        </div>
                        
                        <div class="sectionContent">
                            <p>{{$resume->objective}}</p>
                        </div>
                    </article>
                    <div class="clear"></div>
                </section>

                <section>
                    <article>
                        <div class="sectionTitle">
                            <h1>Other Skill</h1>
                        </div>
                        
                        <div class="sectionContent">
                            <p>{{$resume->other_skills}}</p>
                        </div>
                    </article>
                    <div class="clear"></div>
                </section>

                <section>
                    <article>
                        <div class="sectionTitle">
                            <h1>Websites</h1>
                        </div>
                        
                        <div class="sectionContent">
                            <p>{{$resume->websites}}</p>
                        </div>
                    </article>
                    <div class="clear"></div>
                </section>

                <section>
                    <article>
                        <div class="sectionTitle">
                            <h1>Seminars Attended</h1>
                        </div>
                        
                        <div class="sectionContent">
                            <p>{{$resume->seminars_attended}}</p>
                        </div>
                    </article>
                    <div class="clear"></div>
                </section>

                <section>
                    <article>
                        <div class="sectionTitle">
                            <h1>Awards</h1>
                        </div>
                        
                        <div class="sectionContent">
                            <p>{{$resume->awards}}</p>
                        </div>
                    </article>
                    <div class="clear"></div>
                </section>
            </div>            
        </div>
    </div>
        <div style="margin-top:10px; margin-bottom:10px;">
        {!! link_to(action('ResumesController@edit', $resume->id) , 'update', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
{{-- <div class="container">
    <div class="resume-info">
        <div class="row">
            <div class="col-md-12">
                <h3 id="resume-info-title">Resume information </h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="photo col-md-offset-2 col-md-3">
                                <div style="background:red; width: 200px; height: 200px; display: inline-block; text-align: center;">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h2>
                                    {{ $resume->f_name }}
                                    {{ $resume->m_name }}
                                    {{ $resume->l_name }}
                                </h2>
                                <h4>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-{{ $resume->address1 }}
                                    {{ $resume->address2 }}
                                    {{ $resume->city }}
                                    {{ $resume->country }}
                                </h4>
                                <h4>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-{{ $resume->phone_number }}
                                </h4>
                                <h4>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-{{ $resume->email }}
                                </h4>
                            </div>
                        </div>
                        <h4 class="resume-info-sub-title">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            Personal Information
                        </h4>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Age</label>
                            <div class="col-sm-10">
                                {{ $age }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Birth date</label>
                            <div class="col-sm-10">
                                {{ $birth_date }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Gender</label>
                            <div class="col-sm-10">
                                {{ $resume->l_name }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Religion</label>
                            <div class="col-sm-10">
                                {{ $resume->birth_date }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Marital Status</label>
                            <div class="col-sm-10">
                                {{ $resume->birth_date }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <h4 class="resume-info-sub-title">
                            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                            Education
                        </h4>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">University</label>
                            <div class="col-sm-10">
                                {{ $resume->university }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Field of study</label>
                            <div class="col-sm-10">
                                {{ $resume->field_of_study }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Program of study</label>
                            <div class="col-sm-10">
                                {{ $resume->program_of_study }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Schoool year attended</label>
                            <div class="col-sm-10">
                                {{ $resume->university_enter_month }}
                                {{ $resume->university_enter_year }}
                                &nbsp;&nbsp; - &nbsp;&nbsp;
                                {{ $resume->university_graduate_month }}
                                {{ $resume->university_graduate_year }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <h4 class="resume-info-sub-title">
                            <i class="fa fa-trophy" aria-hidden="true"></i>
                            Experience
                        </h4>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Work experience</label>
                            <div class="col-sm-10">
                                {{ $resume->experience }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Other work experience</label>
                            <div class="col-sm-10">
                                {{ $resume->objective }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <h4 class="resume-info-sub-title">
                            <i class="fa fa-code" aria-hidden="true"></i>
                            Programming language
                        </h4>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">PHP</label>
                            <div class="col-sm-10">
                                {{ $skill_languages['php'] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">ruby</label>
                            <div class="col-sm-10">
                                {{ $skill_languages['ruby'] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Java</label>
                            <div class="col-sm-10">
                                {{ $skill_languages['java'] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">python</label>
                            <div class="col-sm-10">
                                {{ $skill_languages['python'] }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:10px; margin-bottom:10px;">
        {!! link_to(action('ResumesController@edit', $resume->id) , 'update', ['class' => 'btn btn-primary']) !!}
    </div>
</div> --}}

@endsection
