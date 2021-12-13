package com.example.java.utils.session;

import com.example.java.utils.LanguageType;
import com.example.java.utils.ThemeType;
import lombok.RequiredArgsConstructor;

import javax.servlet.http.HttpSession;
import java.util.HashMap;
import java.util.Map;

@RequiredArgsConstructor
public class SessionHelper {
    private final HttpSession session;

    private static Map<SessionAttribute, Object> mapAttribute = new HashMap<>();

    static {
        mapAttribute.put(SessionAttribute.NAME, "");
        mapAttribute.put(SessionAttribute.LANGUAGE, LanguageType.RU);
        mapAttribute.put(SessionAttribute.THEME, ThemeType.LIGHT);
    }

    public Object getAttribute(SessionAttribute sessionAttribute) {
        Object attribute = this.session.getAttribute(sessionAttribute.name());

        if (attribute == null) {
            Object defaultAttribute = mapAttribute.get(sessionAttribute);
            attribute = defaultAttribute;

            this.setAttribute(sessionAttribute, defaultAttribute);
        }

        return attribute;
    }

    public void setAttribute(SessionAttribute sessionAttribute, Object attribute) {
        this.session.setAttribute(sessionAttribute.name(), attribute);
    }
}
