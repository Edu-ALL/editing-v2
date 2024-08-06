@extends('layouts.email')

@section('content')
<layout label='Section 4'>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <!-- Row Green -->
                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                    bgcolor="#ffffff">
                    <tr>
                        <td class="img"
                            style="font-size:0pt; line-height:0pt; text-align:left"
                            width="10" bgcolor="#0adb1f"></td>
                        <td class="img"
                            style="font-size:0pt; line-height:0pt; text-align:left"
                            width="22"></td>
                        <td>
                            <table width="100%" border="0" cellspacing="0"
                                cellpadding="0">
                                <tr>
                                    <!-- Column -->
                                    <th class="column"
                                        style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; Margin:0"
                                        width="404">
                                        <table width="100%" border="0" cellspacing="0"
                                            cellpadding="0">
                                            <tr>
                                                <td width="404">
                                                    <table width="100%" border="0"
                                                        cellspacing="0" cellpadding="0"
                                                        class="spacer"
                                                        style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                        <tr>
                                                            <td height="15"
                                                                class="spacer"
                                                                style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                                &nbsp;</td>
                                                        </tr>
                                                    </table>

                                                    <div class="h5-2"
                                                        style="color:#555555; font-family:Arial,sans-serif; font-size:14px; line-height:20px; text-align:left; text-transform:capitalize">
                                                        <p>Hi Managing Editor,</p>
                                                    </div>
                                                    <table width="100%" border="0"
                                                        cellspacing="0" cellpadding="0"
                                                        class="spacer"
                                                        style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                        <tr>
                                                            <td height="6"
                                                                class="spacer"
                                                                style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                                &nbsp;</td>
                                                        </tr>
                                                    </table>

                                                    <div class="text2"
                                                        style="color:#777777; font-family:Arial,sans-serif; font-size:12px; line-height:20px; text-align:left">
                                                        <br>
                                                        <p>{{ $editor->first_name.' '.$editor->last_name }}
                                                            has submitted their
                                                            assigned essay:</p>
                                                        <br>
                                                        <b>Mentor:</b>
                                                        {{ $mentor->first_name.' '.$mentor->last_name }}
                                                        <br>
                                                        <b>Client:</b>
                                                        {{ $client->first_name.' '.$client->last_name }}
                                                        <br>
                                                        <b>Essay Title:</b>
                                                        {{ $essay->essay_title }}
                                                        <br>
                                                        <b>Essay Deadline:</b>
                                                        {{ date('D, d M Y', strtotime($essay->essay_deadline)) }}
                                                        <br>
                                                        <b>Application Due Date:</b>
                                                        {{ date('D, d M Y', strtotime($essay->application_deadline)) }}
                                                        <br>
                                                        <b>Target University:</b>
                                                        {{ $essay->university->university_name }}
                                                        <br>
                                                        <b>Essay Prompt:</b>
                                                        <i>{!! $essay->essay_prompt !!}</i>
                                                        <br>

                                                        <p>Please review this essay and
                                                            return it to the mentor or
                                                            ask
                                                            the editor for another round
                                                            of
                                                            revision.</p>
                                                        <br>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </th>
                                </tr>
                            </table>
                        </td>
                        <td class="content-spacing"
                            style="font-size:0pt; line-height:0pt; text-align:left"
                            width="30"></td>
                    </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                    class="spacer"
                    style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                    <tr>
                        <td height="10" class="spacer"
                            style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                            &nbsp;</td>
                    </tr>
                </table>

                <!-- END Row Green -->
            </td>
        </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer"
        style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
        <tr>
            <td height="10" class="spacer"
                style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                &nbsp;</td>
        </tr>
    </table>

</layout>

@endsection