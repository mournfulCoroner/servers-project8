package com.example.java.modules;

import com.example.java.utils.LanguageType;
import com.example.java.utils.ThemeType;
import lombok.Data;
import org.springframework.data.redis.core.RedisHash;

@Data
public class UserInfo {
    private LanguageType language;
    private ThemeType theme;
    private String name;
}
