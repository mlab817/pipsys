@extends('layouts.header-only')

@section('page-header')
    <x-page-header title="New Program/Project"></x-page-header>
@stop

@section('content')
    <form action="{{ route('projects.store') }}" method="POST" accept-charset="UTF-8" class="mt-4 mb-4">
        @csrf

        <div class="Box">

            <div class="Box-header">

                <h1 class="Box-title">New Program/Project</h1>

            </div>

            <div class="Box-body">

                <x-subhead subhead="General Information" id="general-information"></x-subhead>

                <x-form-group field-name="title" label="Title">
                    <input type="text" class="form-control input-block" name="title" id="title" value="{{ old('title') }}">
                    <p class="note">
                        The project title should be identical with the project's title in the budget proposal submitted to DBM.
                    </p>
                </x-form-group>

                <x-form-group field-name="ref_pap_type_id" label="Program or Project">
                    @foreach($papTypes as $option)
                        <x-checkbox type="radio" field-name="ref_pap_type_id" value="{{ $option->id }}" label="{{ $option->label }}" description="{{ $option->description }}"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="bases" label="Basis for Implementation">
                    @foreach($bases as $option)
                        <x-checkbox field-name="bases[]" value="{{ $option->id }}" label="{{ $option->label }}" description="{{ $option->description }}"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="description" label="PAP Description">
                    <textarea name="description" id="description" class="form-control" rows="6" style="resize: none;">{{ old('description') }}</textarea>
                    <p class="note">
                        Identify the Components of the Program/Project. If a Program, please identify the sub-programs/projects and explain the objective of the program/project in terms of responding to the PDP/ RM. <br/>If the PAP will involve construction of a government facility, specify the definite purpose for the facility to be constructed.
                    </p>
                </x-form-group>

                <x-subhead subhead="Implementing Agency" id="implementing-agency"></x-subhead>

                <x-form-group field-name="office_id" label="Office">
                    <x-select field-name="office_id" :options="$offices"></x-select>
                </x-form-group>

                <x-form-group field-name="operating_units" label="Other Implementing Agencies">
                    @foreach($operatingUnits as $option)
                        <x-checkbox field-name="operating_units[]" value="{{ $option->id }}" label="{{ $option->label }}" description="{{ $option->description }}"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-subhead subhead="Spatial Coverage" id="spatial-coverage"></x-subhead>

                <x-form-group field-name="ref_spatial_coverage_id" label="Spatial Coverage">
                    <x-select field-name="ref_spatial_coverage_id" :options="$spatialCoverages"></x-select>
                </x-form-group>

                <x-form-group field-name="regions" label="Regions">
                    @foreach($regions as $option)
                        <x-checkbox field-name="regions[]" value="{{ $option->id }}" label="{{ $option->label }}" description="{{ $option->description }}"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-subhead subhead="Approval Level" id="approval-level"></x-subhead>

                <x-form-group field-name="iccable" label="Will require Investment Coordination Committee/NEDA Board Approval (ICC-able)?">
                    <x-radio-group field-name="iccable" :options="$bool"></x-radio-group>
                </x-form-group>

                <x-form-group field-name="ref_approval_level_id" label="Level of Approval">
                    @foreach($approvalLevels as $option)
                        <x-checkbox  field-name="ref_approval_level_id" type="radio" label="{{ $option->label }}" value="{{ $option->id }}"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="approval_date" label="Target/Actual Date of Submission">
                    <input type="date" name="approval_date" id="approval_date" class="form-control input-contrast">
                </x-form-group>

                <x-subhead subhead="Program/Project for Inclusion in Which Programming Document" id="programming-document"></x-subhead>

                <x-form-group field-name="pip" label="Public Investment Program">
                    @foreach($bool as $option)
                        <x-checkbox-trigger field-name="pip" label="{{ $option->label }}" value="{{ $option->id }}">
                            @if($option->id == 1)
                                <span class="d-block mb-1">
                                    Type of PIP:
                                </span>
                                @foreach($pipTypologies as $option)
                                    <x-checkbox type="radio" field-name="ref_pip_typology_id" label="{{ $option->label }}" value="{{ $option->id }}"></x-checkbox>
                                @endforeach
                                </span>
                            @endif
                        </x-checkbox-trigger>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="cip" label="Core Investment Program/Project">
                    @foreach($bool as $option)
                        <x-checkbox-trigger field-name="rdip" label="{{ $option->label }}" value="{{ $option->id }}">
                            @if($option->id == 1)
                                <span class="d-block mb-1">
                                    Type of CIP:
                                </span>
                                @foreach($cipTypes as $option)
                                    <x-checkbox type="radio" field-name="ref_pip_typology_id" label="{{ $option->label }}" value="{{ $option->id }}"></x-checkbox>
                                @endforeach
                            </span>
                            @endif
                        </x-checkbox-trigger>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="trip" label="Three-Year Rolling Infrastructure Program/Project">
                    @foreach($bool as $option)
                        <x-checkbox type="radio" field-name="trip" label="{{ $option->label }}" value="{{ $option->id }}"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="rdip" label="Is the Program/Project included in the RDIP?">
                    @foreach($bool as $option)
                        <x-checkbox-trigger field-name="rdip" label="{{ $option->label }}" value="{{ $option->id }}">
                            @if($option->id == 1)
                                <span class="d-inline-block mt-1">Will require Regional Development Council (RDC) Endorsement?</span>
                                @foreach($bool as $option)
                                    <x-checkbox-trigger field-name="rdc_endorsement_required" label="{{ $option->label }}" value="{{ $option->id }}">
                                        @if($option->id == 1)
                                            <span class="d-inline-block mt-1">Endorsed by the RDC?</span>
                                            @foreach($bool as $option)
                                                <x-checkbox-trigger field-name="rdc_endorsed" label="{{ $option->label }}" value="{{ $option->id }}">
                                                    @if($option->id == 1)
                                                        <span class="d-inline-block mt-1">Date Endorsed</span>
                                                        <input type="date" class="form-control" name="rdc_endorsed_date" id="rdc_endorsed_date">
                                                    @endif
                                                </x-checkbox-trigger>
                                            @endforeach
                                        @endif
                                    </x-checkbox-trigger>
                                @endforeach
                            @endif
                        </x-checkbox-trigger>
                    @endforeach
                </x-form-group>
            </div>

            <div class="Box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </div>


    </form>
@stop
