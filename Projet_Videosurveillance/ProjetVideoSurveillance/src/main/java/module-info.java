module com.example.projetvideosurveillance {
    requires javafx.controls;
    requires javafx.fxml;
    requires java.net.http;
    requires java.desktop;


    opens com.example.projetvideosurveillance to javafx.fxml;
    exports com.example.projetvideosurveillance;
}