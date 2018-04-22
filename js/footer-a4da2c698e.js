'use strict';

(function () {
    var recorder = this.uship.recorder;


    if (recorder) {
        var linkClickData = { type: 'Exit Link Click' };

        var rec = recorder.withSettings({
            methodSinks: {
                linkClick: [recorder.sinks.googleAnalytics, recorder.sinks.console]
            }
        });

        rec.linkClick('.iOS-app-footer-link', 'App Download Apple Store', linkClickData);
        rec.linkClick('.android-app-footer-link', 'App Download Google Play', linkClickData);
        rec.linkClick('.careers-footer-link', 'Careers', linkClickData);
        rec.linkClick('.press-footer-link', 'Press', linkClickData);
        rec.linkClick('.facebook-footer-link', 'Facebook', linkClickData);
        rec.linkClick('.twitter-footer-link', 'Twitter', linkClickData);
        rec.linkClick('.youtube-footer-link', 'Youtube', linkClickData);
        rec.linkClick('.linkedin-footer-link', 'Linkedin', linkClickData);
        rec.linkClick('.howitworks-footer-link', 'How it Works (Footer)', linkClickData);
        rec.linkClick('.company-footer-link', 'Company', linkClickData);
        rec.linkClick('.blog-footer-link', 'Blog', linkClickData);
    }
}).call(this);