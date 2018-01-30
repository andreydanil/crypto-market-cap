@extends('layouts.master')

@section('title', 'Privacy Policy')

@section('content')
    <section id="wrapper">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <h2>{{ $app_name }} - Privacy Policy</h2>
                    <p>This privacy policy sets out how {{ $app_name }} uses and protects any information that you
                        give {{ $app_name }} when you use this website.
                    </p>
                    <p>{{ $app_name }} is committed to ensuring that your privacy is protected. Should we ask you to
                        provide certain information by which you can be identified when using this website, then you can
                        be assured that it will only be used in accordance with this privacy statement.
                    </p>
                    <p>{{ $app_name }} may change this policy from time to time by updating this page. You should check
                        this page from time to time to ensure that you are happy with any changes. This policy is
                        effective from 18/05/2015.
                    </p>
                    <p>What we collect
                    </p>
                    <p>We may collect the following information:</p>
                    <ul>
                        <li>name and job title</li>
                        <li>contact information including email address</li>
                        <li>demographic information such as postcode, preferences and interests</li>
                        <li>other information relevant to customer surveys and/or offers</li>
                    </ul>
                    <p>What we do with the information we gather
                    </p>
                    <p>We require this information to understand your needs and provide you with a better service, and
                        in particular for the following reasons:
                    </p>
                    <p>Internal record keeping.
                    </p>
                    <p>We may use the information to improve our products and services.
                    </p>
                    <p>We may periodically send promotional emailsabout new products, special offers or other
                        information which we think you may find interesting using the email address which you have
                        provided.
                    </p>
                    <p>From time to time, we may also use your information to contact you for market research purposes.
                        We may contact you by email, phone, fax or mail. We may use the information to customise the
                        website according to your interests.
                    </p>
                    <p>Security </p>
                    <p>We are committed to ensuring that your information is secure. In order to prevent unauthorised
                        access or disclosure,we have put in place suitable physical, electronic and managerial
                        procedures to safeguard and secure the information we collect online.
                    </p>
                    <p>How we use cookies
                    </p>
                    <p>A cookie is a small file which asks permission to be placed on your computer's hard drive. Once
                        you agree, the file is added and the cookie helps analyse web traffic or lets you know when you
                        visit a particular site. Cookies allow web applications to respond to you as an individual. The
                        web application can tailor its operations to your needs, likes and dislikes by gathering and
                        remembering information about your preferences.
                    </p>
                    <p>We use traffic log cookies to identify which pages are being used. This helps us analyse data
                        about web page traffic and improve our website in order to tailor it to customer needs. We only
                        use this information for statistical analysis purposes and then the data is removed from the
                        system.
                    </p>
                    <p>Overall, cookies help us provide you with a better website, by enabling us to monitor which pages
                        you find useful and which you do not. A cookie in no way gives us access to your computer or any
                        information about you, other than the data you choose to share with us.
                    </p>
                    <p>You can choose to accept or decline cookies. Most web browsers automatically accept cookies, but
                        you can usually modify your browser setting to decline cookies if you prefer. This may prevent
                        you from taking full advantage of the website.
                    </p>
                    <p>Links to other websites</p>
                    <p>Our website may contain links to other websites of interest. However, once you have used these
                        links to leave our site, you should note that we do not have any control over that other
                        website. Therefore, we cannot be responsible for the protection and privacy of any information
                        which you provide whilst visiting such sites and such sites are not governed by this privacy
                        statement. You should exercise caution and look at the privacy statement applicable to the
                        website in question.
                    </p>
                    <p>Controlling your personal information
                    </p>
                    <p>You may choose to restrict the collection or use of your personal information in the following
                        ways:
                    </p>
                    <p>whenever you are asked to fill in a form on the website, look for the box that you can click to
                        indicate that you do not want the information to be used by anybody for direct marketing
                        purposes
                    </p>
                    <p>if you have previously agreed to us using your personal information for direct marketing
                        purposes, you may change your mind at any time by <a href="{{ route('contact.index') }}">contacting us</a>.
                    </p>
                    <p>We will not sell, distribute or lease your personal information to third parties unless we have
                        your permission or are required by law to do so. We may use your personal information to send
                        you promotional information about third parties which we think you may find interesting if you
                        tell us that you wish this to happen.
                    </p>
                    <p>You may request details of personal information which we hold about you under the Data Protection
                        Act 1998. A small fee will be payable. If you would like a copy of the information held on you
                        please <a href="{{ route('contact.index') }}">contact us</a>.
                    </p>
                    <p>If you believe that any information we are holding on you is incorrect or incomplete, please
                        write to or email us as soon as possible, at the above address. We will promptly correct any
                        information found to be incorrect.
                    </p>
                    <p>With your consent, we may collect information about the specific location of your mobile device
                        (for example, by using GPS or Bluetooth). You can revoke this consent at any time by changing
                        the preferences on your device, but doing so may affect your ability to use all of the features
                        and functionality of our Services.
                    </p>
                    <p>We may offer social sharing features or other integrated tools that let you share content or
                        actions you take on our Services with other media. Your use of these features enables the
                        sharing of certain information with your friends or the public, depending on the settings you
                        establish with the third party that provides the social sharing feature. For more information
                        about the purpose and scope of data collection and processing in connection with social sharing
                        features, please visit the privacy policies of the third parties that provide these social
                        sharing features.
                    </p>
                    <p>You may opt out of receiving promotional communications from us by following the instructions in
                        those communications. If you opt out, we may still send you non-promotional communications, such
                        as information about your account or your use of our Services.
                    </p>
                    <p>We may change this Privacy Policy from time to time. If we do, we will let you know by revising
                        the date at the top of the policy. If we make a change to this policy that, in our sole
                        discretion, is material, we will provide you with additional notice. We encourage you to review
                        the Privacy Policy whenever you access or use our Services or otherwise interact with us to stay
                        informed about our information practices and the ways you can help protect your privacy. If you
                        continue to use our Services after Privacy Policy changes go into effect, you consent to the
                        revised policy.</p>
                </div>
            </div>
        </div>
    </section>
@stop