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
                            width="10" bgcolor="#ffc700"></td>
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
                                        <table width="100%" border="0"
                                            cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="404">
                                                    <table width="100%"
                                                        border="0" cellspacing="0"
                                                        cellpadding="0" class="spacer"
                                                        style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                        <tr>
                                                            <td height="15"
                                                                class="spacer"
                                                                style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                                &nbsp;</td>
                                                        </tr>
                                                    </table>

                                                    <div class="h5-2"
                                                        style="color:#555555; font-family:Arial,sans-serif; font-size:14px; line-height:20px; text-align:left; text-transform:uppercase">
                                                        <b>Reset Password</b>
                                                    </div>
                                                    <table width="100%"
                                                        border="0" cellspacing="0"
                                                        cellpadding="0" class="spacer"
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
                                                        Click the button to reset your
                                                        password.
                                                    </div>
                                                    <table width="100%"
                                                        border="0" cellspacing="0"
                                                        cellpadding="0" class="spacer"
                                                        style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                        <tr>
                                                            <td height="15"
                                                                class="spacer"
                                                                style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                                &nbsp;</td>
                                                        </tr>
                                                    </table>

                                                </td>
                                            </tr>
                                        </table>
                                    </th>
                                    <!-- END Column -->
                                    <th class="m-td"
                                        style="font-size:0pt; line-height:0pt; text-align:left"
                                        width="18"></th>
                                    <!-- END Column -->
                                    <!-- Column -->
                                    <th class="column"
                                        style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; Margin:0">
                                        <table width="100%" border="0"
                                            cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td>
                                                    <div class="hide-for-mobile">
                                                        <table width="100%"
                                                            border="0"
                                                            cellspacing="0"
                                                            cellpadding="0"
                                                            class="spacer"
                                                            style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                            <tr>
                                                                <td height="10"
                                                                    class="spacer"
                                                                    style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                                    &nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </div>

                                                    <!-- Button -->
                                                    <table width="100%"
                                                        border="0" cellspacing="0"
                                                        cellpadding="0"
                                                        bgcolor="#2079a3">
                                                        <tr>
                                                            <td class="img"
                                                                style="font-size:0pt; line-height:0pt; text-align:left"
                                                                width="30"></td>
                                                            <td>
                                                                <table width="100%"
                                                                    border="0"
                                                                    cellspacing="0"
                                                                    cellpadding="0"
                                                                    class="spacer"
                                                                    style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                                    <tr>
                                                                        <td height="12"
                                                                            class="spacer"
                                                                            style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                                            &nbsp;</td>
                                                                    </tr>
                                                                </table>

                                                                <div class="text-button"
                                                                    style="color:#ffffff; font-family:Arial,sans-serif; font-size:12px; line-height:16px; text-align:center; text-transform:uppercase">
                                                                    <a href="{{ route('form-reset-password-editor', ['email' => $email, 'token' => $token, 'role' => 'editor']) }}"
                                                                        id="action-btn"
                                                                        target="_blank"
                                                                        class="link-white"
                                                                        style="color:#ffffff; text-decoration:none"><span
                                                                            class="link-white"
                                                                            style="color:#ffffff; text-decoration:none">Reset
                                                                            Your
                                                                            Password</span></a>
                                                                </div>
                                                                <table width="100%"
                                                                    border="0"
                                                                    cellspacing="0"
                                                                    cellpadding="0"
                                                                    class="spacer"
                                                                    style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                                    <tr>
                                                                        <td height="12"
                                                                            class="spacer"
                                                                            style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                                            &nbsp;</td>
                                                                    </tr>
                                                                </table>

                                                            </td>
                                                            <td class="img"
                                                                style="font-size:0pt; line-height:0pt; text-align:left"
                                                                width="8"></td>

                                                            <td class="img"
                                                                style="font-size:0pt; line-height:0pt; text-align:left"
                                                                width="20"></td>
                                                        </tr>
                                                    </table>
                                                    <!-- END Button -->

                                                    <table width="100%"
                                                        border="0" cellspacing="0"
                                                        cellpadding="0" class="spacer"
                                                        style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                        <tr>
                                                            <td height="10"
                                                                class="spacer"
                                                                style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                                &nbsp;</td>
                                                        </tr>
                                                    </table>

                                                </td>
                                            </tr>
                                        </table>
                                    </th>
                                    <!-- END Column -->
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
    <table width="100%" border="0" cellspacing="0" cellpadding="0"
        class="spacer"
        style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
        <tr>
            <td height="10" class="spacer"
                style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                &nbsp;</td>
        </tr>
    </table>

</layout>

@endsection