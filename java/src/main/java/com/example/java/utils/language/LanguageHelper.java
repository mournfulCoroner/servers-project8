package com.example.java.utils.language;

import com.example.java.utils.LanguageType;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Component;

@Component
@RequiredArgsConstructor
public class LanguageHelper {
    private final Eng eng;
    private final Rus rus;

    public AbsDictionary getDictionary(LanguageType languageType) {
        return languageType.equals(LanguageType.EN) ? eng : rus;
    }
}
