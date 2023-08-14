package com.example.projetvideosurveillance;

import javafx.scene.control.Label;
import javafx.scene.image.ImageView;

import java.io.IOException;
import java.net.InetAddress;
import java.net.UnknownHostException;
import java.net.http.HttpClient;

public class Verification extends Main {
    private String ip;
    private Boolean verification;

    public Verification(String ip) {
        this.ip = ip;
    }

    public Boolean getVerification() throws IOException {
        InetAddress verificationip = InetAddress.getByName(this.ip);
        if (verificationip.isReachable(500)) {
            this.verification = true;
        } else {
            this.verification = false;
        }
        return this.verification;
    }
}


