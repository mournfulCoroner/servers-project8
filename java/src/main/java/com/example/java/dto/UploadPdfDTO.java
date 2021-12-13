package com.example.java.dto;

import lombok.Data;
import org.springframework.web.multipart.MultipartFile;

@Data
public class UploadPdfDTO {
    MultipartFile userfile;
}
